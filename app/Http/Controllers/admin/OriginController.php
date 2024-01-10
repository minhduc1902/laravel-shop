<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OriginController extends Controller
{
    public function index(Request $request){
        $origins = Origin::latest('id');

        if(!empty($request->get('keyword'))) {
            $origins = $origins->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $origins = $origins->paginate(10);

        return view('admin.origins.list', compact('origins'));

    }

    public function create() {
        return view('admin.origins.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:origins'
        ]);

        if($validator->passes()) {
            $origins = new Origin();
            $origins->name = $request->name;
            $origins->slug = $request->slug;
            $origins->status = $request->status;
            $origins->save();

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
        $origins = Origin::find($id);

        if(empty($origins)) {
            session()->flash('error', 'Không tìm thấy bản ghi');
            return redirect()->route('origins.index');
        }

//        $data['origin'] = $origins;

        return view('admin.origins.edit', compact('origins'));
    }

    public function update(Request $request, $id) {
        $origin = Origin::find($id);

        if(empty($origin)) {
            session()->flash('error', 'Không tìm thấy xuất sứ.');

            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Không tìm thấy xuất sứ.'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:origins,slug,'.$request->id.',id',
        ]);

        if($validator->passes()) {
            $origin->name = $request->name;
            $origin->slug = $request->slug;
            $origin->status = $request->status;
            $origin->save();

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
        $origin = Origin::find($id);

        if(empty($origin)) {
            session()->flash('error', 'Không tìm thấy xuất sứ.');
            return response()->json([
                'status' => true,
                'message' => 'Không tìm thấy xuất sứ.'
            ]);
        }

        $origin->delete();

        session()->flash('success', 'Xuất sứ được xóa thành công.');

        return response()->json([
            'status' => true,
            'message' => 'Xuất sứ được xóa thành công.'
        ]);
    }
}
