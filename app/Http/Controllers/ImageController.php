<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request) {
        
        $image = $request->file('file');

        $nameImage = Str::uuid() . "." . $image->extension(); // Generate a unique ID for each image

        $imageServer = Image::make($image);
        $imageServer->fit(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $nameImage;

        $imageServer->save($imagePath);

        return response()->json([ 'imagen' => $nameImage ]);
    }
}