<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TempImages;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TempImagesController extends Controller
{
    public function create(Request $request) {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $newFileName = time().'.'.$extension;

            $tempImage = new TempImages();
            $tempImage->name = $newFileName;
            $tempImage->save();

            $image->move(public_path('temp'), $newFileName);

            // Generate thumbnail
            $sourcePath = public_path('temp') . '/' . $newFileName;
            $destPath = public_path('temp/thumb') . '/' . $newFileName;
            $image = Image::make($sourcePath);
            $image->fit(300, 275);
            $image->save($destPath);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('temp/thumb/' . $newFileName),
                'message' => 'Hình ảnh được tải lên thành công.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy hình ảnh trong yêu cầu.'
            ]);
        }
    }
}
