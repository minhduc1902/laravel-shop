<?php

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\OriginController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TempImagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\SettingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{SubCategorySlug?}', [ShopController::class, 'index'])->name('front.shop');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('front.product');
Route::get('/cart', [CartController::class, 'cart'])->name('front.cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('front.addToCart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('front.updateCart');
Route::post('/delete-item', [CartController::class, 'deleteItem'])->name('front.deleteItem.cart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}', [CartController::class, 'thankyou'])->name('front.thankyou');

Route::group(['prefix' => 'account'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');

        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');

    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/my-orders', [AuthController::class, 'orders'])->name('account.orders');
        Route::get('/order-detail/{orderId}', [AuthController::class, 'orderDetail'])->name('account.orderDetail');
        Route::get('/change-password', [AuthController::class, 'showchangePasswordForm'])->name('account.changePassword');
        Route::post('/process-change-password', [AuthController::class, 'changePassword'])->name('account.processChangePassword');

        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        });

        //Order Routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('orders.detail');
        Route::post('/orders/change-status/{id}', [OrderController::class, 'changeOrderStatus'])->name('orders.changeOrderStatus');

        //Users Routes

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
        });

        //Get Slug
        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = str_slug($request->title);
            }

            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');

        //temp-image.create
        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');

        //setting routes
        Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');

        Route::prefix('origins')->group(function () {
            Route::get('/', [OriginController::class, 'index'])->name('origins.index');
            Route::get('/create', [OriginController::class, 'create'])->name('origins.create');
            Route::post('/store', [OriginController::class, 'store'])->name('origins.store');
            Route::get('/edit/{id}', [OriginController::class, 'edit'])->name('origins.edit');
            Route::put('/update/{id}', [OriginController::class, 'update'])->name('origins.update');
            Route::delete('/delete/{id}', [OriginController::class, 'delete'])->name('origins.delete');
        });

        Route::prefix('sub-categories')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('sub-categories.index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('sub-categories.store');
            Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
            Route::put('/update/{id}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
            Route::delete('/delete/{id}', [SubCategoryController::class, 'delete'])->name('sub-categories.delete');
        });

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/store', [ProductController::class, 'store'])->name('products.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        });

        Route::get('/get-products', [ProductController::class, 'getProduct'])->name('product.getProducts');
        Route::get('/product-subCategories', [ProductSubCategoryController::class, 'index'])->name('product-subCategories.index');
        Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images/delete', [ProductImageController::class, 'delete'])->name('product-images.delete');
    });
});
