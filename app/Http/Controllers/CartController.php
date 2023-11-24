<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $product = Product::with('product_images')->find($request->id);

        if($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy sản phẩm.'
            ]);
        }

        if(Cart::count() > 0) {
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach($cartContent as $item) {
                if($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }

            if($productAlreadyExist == false) {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '' ]);
                $status = true;
                $message = $product->title.' thêm vào giỏ hàng thành công.';
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = $product->title.' đã có trong giỏ hàng.';
            }

        } else {
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '' ]);
            $status = true;
            $message = $product->title.' thêm vào giỏ hàng thành công.';
            session()->flash('success', $message);
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function cart() {
        $cartContent = Cart::content();
        $data['cartContent'] = $cartContent;
        return view('front.cart', $data);
    }

    public function updateCart(Request $request) {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = Product::find($itemInfo->id);

        //check qty available ín stock
        if($product->track_qty == 'Yes') {

            if($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cập nhật giỏ hàng thành công.';
                $status = true;
                session()->flash('success', $message);
            } else {
                $message = 'Request qty('.$qty.') not available in stock.';
                $status = false;
                session()->flash('error', $message);
            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cập nhật giỏ hàng thành công.';
            $status = true;

            session()->flash('success', $message);
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function deleteItem(Request $request) {
        $itemInfo = Cart::get($request->rowId);

        if($itemInfo == null) {
            $errorMessage = 'Không tìm thấy sản phẩm trong giỏ hàng.';
            session()->flash('error', $errorMessage);

            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);
        $message = 'Đã xóa sản phẩm khỏi giỏ hàng thành công.';
        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function checkout() {
        if(Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        if(Auth::check() == false) {
            if(!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('account.login');
        }
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();

        session()->forget('url.intended');

        return view('front.checkout', [
            'customerAddress' =>  $customerAddress
        ]);
    }

    public function processCheckout(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Xin vui lòng sửa lỗi',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country' => $request->country,
                'address' => $request->address,
                'mobile' => $request->mobile
            ]
        );

        if($request->payment_method == 'cod') {
            $grandTotal = Cart::subtotal(2, '.', '');

            $order = new Order;
            $order->grand_total = $grandTotal;
            $order->payment_status = 'not paid';
            $order->status = 'pending';
            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->country = $request->country;
            $order->address = $request->address;
            $order->mobile = $request->mobile;
            $order->notes =  $request->order_notes;
            $order->save();

            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price*$item->qty;
                $orderItem->save();

                //Update product stock
                $productData = Product::find($item->id);
                if($productData->track_qty == 'Yes') {
                    $currentQty = $productData->qty;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->qty = $updatedQty;
                    $productData->save();
                }
            }
            session()->flash('success', 'Đơn hàng đã lưu thành công.');

            Cart::destroy();
            return response()->json([
                'message' => 'Đơn hàng đã lưu thành công.',
                'orderId' => $order->id,
                'status' => true,
            ]);

        } else {
            $grandTotal = Cart::subtotal(2, '.', '');

            $order = new Order;
            $order->grand_total = $grandTotal;
            $order->payment_status = 'paid';
            $order->status = 'pending';
            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->country = $request->country;
            $order->address = $request->address;
            $order->mobile = $request->mobile;
            $order->notes =  $request->order_notes;
            $order->save();

            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price*$item->qty;
                $orderItem->save();

                //Update product stock
                $productData = Product::find($item->id);
                if($productData->track_qty == 'Yes') {
                    $currentQty = $productData->qty;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->qty = $updatedQty;
                    $productData->save();
                }
            }
            session()->flash('success', 'Đơn hàng đã lưu thành công.');

            Cart::destroy();
            return response()->json([
                'message' => 'Đơn hàng đã lưu thành công.',
                'orderId' => $order->id,
                'status' => true,
            ]);
        }
    }

    public function thankyou($id) {
        return view('front.thanks', [
            'id' => $id
        ]);
    }
}
