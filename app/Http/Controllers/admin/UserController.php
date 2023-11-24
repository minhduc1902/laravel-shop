<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request) {
        $users = User::latest();
        $users = $users->paginate(10);

        if(!empty($request->get('keyword'))) {
            $user = $users->where('name', 'like', '%'.$request->get('keyword'). '%');
        }

        return view('admin.users.list', [
            'users' => $users
        ]);
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'phone' => 'required',
            'status' => 'required'
        ]);

        if($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->save();

            session()->flash('success', 'Tài khoản được tạo thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Tài khoản được tạo thành công.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $id) {
        $user = User::find($id);

        if($user == null) {
            session()->flash('error', 'Không tìm thấy tải khoản.');
                return redirect()->route('users.index');
        }

        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);

        if(empty($user)) {
            session()->flash('error', 'Không tìm thấy tải khoản');

            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Không tìm thấy tải khoản'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'phone' => 'required',
            'status' => 'required'
        ]);

        if($validator->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->password != '') {
                $user->password = Hash::make($request->password);

            }
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            session()->flash('success', 'Tài khoản được cập nhật thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Tài khoản được cập nhật thành công.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function delete($id) {
        $user = User::find($id);

        if(empty($user)) {
            session()->flash('error', 'Không tìm thấy tài khoản.');
            return response()->json([
                'status' => true,
                'message' => 'Không tìm thấy tài khoản.'
            ]);
        }

        $user->delete();
        session()->flash('success', 'Tài khoản được xóa thành công.');

        return response()->json([
            'status' => true,
            'message' => 'Tài khoản được xóa thành công.'
        ]);
    }
}
