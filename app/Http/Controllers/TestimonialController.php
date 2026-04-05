<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return response()->json([
            'testimonials' => $testimonials
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'function' => 'required'
        ]);
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->function = $request->function;
        $testimonial->testinomy = $request->testinomy;
        $testimonial->rating = $request->rating;

        if ($request->hasFile('image')) {
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            \request()->image->move(public_path('upload'), $file_name);
            $testimonial->image = $file_name;
        }

        $testimonial->save();
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return response()->json([
            'testimonial' => $testimonial
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'function' => 'required'
        ]);
        $testimonial = Testimonial::find($id);
        $testimonial->name = $request->name;
        $testimonial->function = $request->function;
        $testimonial->testinomy = $request->testinomy;
        $testimonial->rating = $request->rating;

        if ($testimonial->image != $request->image) {

            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $testimonial->image;
            if (file_exists($image)) {
                @unlink($image);
            }

            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            \request()->image->move(public_path('upload'), $file_name);
            $testimonial->image = $file_name;
        }

        $testimonial->save();
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        $upload_path = public_path() . "/upload/";
        $image = $upload_path . $testimonial->image;
        if (file_exists($image)) {
            @unlink($image);
        }
        $testimonial->delete();
    }
}
