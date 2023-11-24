<?php

namespace App\Http\Controllers\admin;

use App\Components\Recusive;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $category;
    public function __construct( Category $category)
    {
        $this->category = $category;
    }


    public function index(Request $request){
        $categories = Category::latest();
        if(!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%')
                                    ->orWhere('id', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $categories->paginate(10);
        return view('admin.category.list', compact('categories'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

        if($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            session()->flash('success', 'Danh mục được tạo thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Danh mục được tạo thành công.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $id) {
        $category = Category::find($id);
        if(empty($category)) {
            return redirect()->route('categories.index');
        }

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);

        if(empty($category)) {
            session()->flash('error', 'Không tìm thấy danh mục.');

            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Không tìm thấy danh mục.'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$request->id.',id',
        ]);

        if($validator->passes()) {
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            session()->flash('success', 'Danh mục được cập nhật thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Danh mục được cập nhật thành công.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function delete($id) {
        $category = Category::find($id);

        if(empty($category)) {
            session()->flash('error', 'Không tìm thấy danh mục.');
            return response()->json([
                'status' => true,
                'message' => 'Không tìm thấy danh mục.'
            ]);
        }

        $category->delete();

        session()->flash('success', 'Danh mục được xóa thành công.');

        return response()->json([
            'status' => true,
            'message' => 'Danh mục được xóa thành công.'
        ]);
    }
}
