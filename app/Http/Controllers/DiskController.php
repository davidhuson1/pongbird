<?php

namespace App\Http\Controllers;

use App\Models\User;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class DiskController extends Controller
{

    public function uploadImageToS3(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->hashName();

            // Resize to 200 pixels using the Intervention Image library
            $img = Image::make($image->getRealPath())->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = 'images/' . $filename;
            Storage::disk('s3')->put($path, $img->stream()->__toString());

            User::where('id', auth()->id())->update([
                'profile_picture' =>  $awsPath = Storage::disk('s3')->url($path)
            ]);

            return response()->json(['url' => $awsPath], 200);
        }
    }
}
