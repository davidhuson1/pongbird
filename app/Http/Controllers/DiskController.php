<?php

namespace App\Http\Controllers;

use App\Models\User;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\EncodedImage;


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
            $path = 'images/' . $filename;

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);

            // scale to fixed height
            $img = $img->cover(500, 500);

            // encode in webp format
            $encodedImg = $img->toWebp(75);

            Storage::disk('s3')->put($path, $encodedImg);

            User::where('id', auth()->id())->update([
                'profile_picture' =>  $awsPath = Storage::disk('s3')->url($path)
            ]);


            return response()->json(['url' => $awsPath], 200);
        }
    }

    public function delete()
    {
        User::where('id', auth()->id())->update([
            'profile_picture' =>  null
        ]);
    }
}
