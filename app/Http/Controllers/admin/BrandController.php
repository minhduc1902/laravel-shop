<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request){
        $brands = Brand::latest('id');

        if(!empty($request->get('keyword'))) {
            $brands = $brands->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $brands = $brands->paginate(10);

        return view('admin.brands.list', compact('brands'));

    }

    public function create() {
        return view('admin.brands.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);

        if($validator->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            session()->flash('success', 'Xuất sứ được tạo thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Xuất sứ được tạo thành công.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $id) {
        $brand = Brand::find($id);

        if(empty($brand)) {
            session()->flash('error', 'Không tìm thấy bản ghi');
            return redirect()->route('brands.index');
        }

        $data['brand'] = $brand;

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id) {
        $brand = Brand::find($id);

        if(empty($brand)) {
            session()->flash('error', 'Không tìm thấy xuất sứ.');

            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Không tìm thấy xuất sứ.'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$request->id.',id',
        ]);

        if($validator->passes()) {
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            session()->flash('success', 'Xuất sứ được cập nhật thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Xuất sứ được cập nhật thành công.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function delete($id) {
        $brand = Brand::find($id);

        if(empty($brand)) {
            session()->flash('error', 'Không tìm thấy xuất sứ.');
            return response()->json([
                'status' => true,
                'message' => 'Không tìm thấy xuất sứ.'
            ]);
        }

        $brand->delete();

        session()->flash('success', 'Xuất sứ được xóa thành công.');

        return response()->json([
            'status' => true,
            'message' => 'Xuất sứ được xóa thành công.'
        ]);
    }
}
