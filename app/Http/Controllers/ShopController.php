<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Origin;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null) {
        $categorySelected = '';
        $subCategorySelected = '';
        $originsArray = [];

        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $origins = Origin::orderBy('name', 'ASC')->where('status', 1)->get();

        //Apply filter
        $products = Product::where('status', 1);
        if(!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;
        }
        if(!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
            $products = $products->where('sub_category_id', $subCategory->id);
            $subCategorySelected = $subCategory->id;
        }

        if(!empty($request->get('origin'))) {
            $originsArray = explode(',', $request->get('origin'));
            $products = $products->whereIn('origin_id', $originsArray);
        }

        if(!empty($request->get('search'))) {
            $products = $products->where('title', 'like', '%'.$request->get('search').'%');
        }

        if($request->get('sort') != '') {
            if($request->get('sort') == 'latest') {
                $products = $products->orderBy('id', 'DESC');
            } else if($request->get('sort') == 'price_asc') {
                $products = $products->orderBy('price', 'ASC');
            } else {
                $products = $products->orderBy('price', 'DESC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }

        $products = $products->paginate(6);

        $data['categories'] = $categories;
        $data['origins'] = $origins;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['originsArray'] = $originsArray;
        $data['sort'] = $request->get('sort');

        return view('front.shop', $data);
    }

    public function product($slug) {
        $product = Product::where('slug', $slug)->with('product_images')->first();

        if($product == null) {
            abort(404);
        }

        $latestProducts = Product::orderBy('id', 'DESC')->where('status', 1)->take(5)->get();

        $data['product'] = $product;
        $data['latestProducts'] = $latestProducts;

        return view('front.product', $data);
    }
}
