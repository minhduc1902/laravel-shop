<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\TempImages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index() {
        $totalOrders = Order::where('status', '!=', 'cancelled')->count();
        $totalProducts = Product::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');

        $dayBeforeToday = Carbon::now()->subDays(1)->format('Y-m-d H:i:s');

        $tempImages = TempImages::where('created_at', '<=' , $dayBeforeToday)->get();

        foreach ($tempImages as $tempImage) {
            $path = public_path('/temp/'.$tempImage->name);
            $thumbPath = public_path('/temp/thumb/'.$tempImage->name);

            if(File::exists($path)) {
                File::delete($path);
            }

            if(File::exists($thumbPath)) {
                File::delete($thumbPath);
            }

            TempImages::where('id', $tempImage->id)->delete();
        }

        return view('admin.dashboad', [
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalRevenue' => $totalRevenue
        ]);

    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
