<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::latest()->get();
        return response()->json([
            'medias' => $medias
        ], 200);
    }

    public function store(Request $request)
    {
        $media = new Media();
        $media->link = $request->link;
        $media->icon = $request->icon;
        $media->save();
    }

    public function destroy($id)
    {
        $media = Media::find($id);
        $media->delete();
    }
}
