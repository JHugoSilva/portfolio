<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('service')->latest()->get();
        return response()->json([
            'skills' => $skills
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'proficiency' => 'required',
        ]);
        $skill = new Skill();
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->service_id = $request->service_id;
        $skill->save();
    }
}
