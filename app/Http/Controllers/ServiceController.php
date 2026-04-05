<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return response()->json([
            'services' => $services
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $service = new Service();
        $service->name = $request->name;
        $service->icon = $request->icon;
        $service->description = $request->description;
        $service->save();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $service = Service::find($id);
        $service->name = $request->name;
        $service->icon = $request->icon;
        $service->description = $request->description;
        $service->save();
    }

    public function destroy($id)
    {
        $media = Service::find($id);
        $media->delete();
    }
}
