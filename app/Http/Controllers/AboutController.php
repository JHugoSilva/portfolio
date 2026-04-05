<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::latest()->first();
        return response()->json([
            'about' => $about
        ], 200);
    }

    public function show()
    {
        $about = About::find(1);
        return response()->json([
            'about' => $about
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $about = About::latest()->first();
        $about->name = $request->name;
        $about->email = $request->email;
        $about->phone = $request->phone;
        $about->address = $request->address;
        $about->description = $request->description;
        $about->summary = $request->summary;
        $about->tagline = $request->tagline;
        $about->cv = $request->cv;


        if ($request->home_image != $about->home_image) {
            $home_image = \public_path() . "/upload/" . $about->home_image;
            if (file_exists($home_image)) {
                @unlink($home_image);
            }
            $home_image_name = time() . "." . request()->home_image->getClientOriginalExtension();
            \request()->home_image->move(public_path('upload'), $home_image_name);
            $about->home_image = $home_image_name;
        } else {
            $about->home_image = $about->home_image;
        }

        if ($request->banner_image != $about->banner_image) {
            $banner_image = \public_path() . "/upload/" . $about->banner_image;
            if (file_exists($banner_image)) {
                @unlink($banner_image);
            }
            $banner_image_name = time() . "." . request()->banner_image->getClientOriginalExtension();
            \request()->banner_image->move(public_path('upload'), $banner_image_name);
            $about->banner_image = $banner_image_name;
        } else {
            $about->banner_image = $about->banner_image;
        }

        if ($request->cv != $about->cv) {
            $cv = \public_path() . "/upload/" . $about->cv;
            if (file_exists($cv)) {
                @unlink($cv);
            }
            $cv_name = time() . "." . request()->cv->getClientOriginalExtension();
            \request()->cv->move(public_path('upload'), $cv_name);
            $about->cv = $cv_name;
        } else {
            $about->cv = $about->cv;
        }

        $about->save();
    }
}
