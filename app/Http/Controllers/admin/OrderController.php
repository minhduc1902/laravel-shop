<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = Order::latest('orders.created_at')->select('orders.*', 'users.name', 'users.email');
        $orders = $orders->leftJoin('users', 'users.id', 'orders.user_id');

        if($request->get('keyword') != "") {
            $orders = $orders->where('users.name', 'like', '%'.$request->keyword.'%');
            $orders = $orders->orWhere('users.email', 'like', '%'.$request->keyword.'%');
            $orders = $orders->orWhere('orders.id', 'like', '%'.$request->keyword.'%');
        }

        $orders = $orders->paginate(10);

        return view('admin.orders.list', [
            'orders' => $orders
        ]);
    }

    public function detail($id) {
        $order = Order::where('id', $id)->first();

        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('admin.orders.detail', [
            'order' => $order,
            'orderItems' => $orderItems,
        ]);
    }

    public function changeOrderStatus(Request $request, $id) {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        session()->flash('success', 'Trạng thái đơn hàng đã được thay đổi thành công.');

        return response()->json([
           'status' => true,
           'message' => 'Trạng thái đơn hàng đã được thay đổi thành công.'
        ]);
    }
}
