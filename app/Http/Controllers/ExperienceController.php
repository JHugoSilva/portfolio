<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::latest()->get();
        return response()->json([
            'experiences' => $experiences
        ], 200);
    }

    public function store(Request $request)
    {
        $experience = new Experience();
        $experience->company = $request->company;
        $experience->period = $request->period;
        $experience->position = $request->position;
        $experience->save();
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::find($id);
        $experience->company = $request->company;
        $experience->period = $request->period;
        $experience->position = $request->position;
        $experience->save();
    }

    public function destroy($id)
    {
        $experience = Experience::find($id);
        $experience->delete();
    }
}
