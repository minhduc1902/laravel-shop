<?php

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\TempImagesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login');

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

        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');
    });

    Route::prefix('brands')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('brands.index');

        Route::get('/create', [BrandController::class, 'create'])->name('brands.create');

        Route::post('/store', [BrandController::class, 'store'])->name('brands.store');

        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit');

        Route::put('/update/{id}', [BrandController::class, 'update'])->name('brands.update');

        Route::delete('/delete/{id}', [BrandController::class, 'delete'])->name('brands.delete');
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

    Route::get('/product-subCategories', [ProductSubCategoryController::class, 'index'])->name('product-subCategories.index');
});
