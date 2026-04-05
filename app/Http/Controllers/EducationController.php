<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::latest()->get();
        return response()->json([
            'educations' => $educations
        ], 200);
    }

    public function store(Request $request)
    {
        $education = new Education();
        $education->institution = $request->institution;
        $education->period = $request->period;
        $education->degree = $request->degree;
        $education->departement = $request->departement;
        $education->save();
    }

    public function update(Request $request, $id)
    {
        $education = Education::find($id);
        $education->institution = $request->institution;
        $education->period = $request->period;
        $education->degree = $request->degree;
        $education->departement = $request->departement;
        $education->save();
    }

    public function destroy($id)
    {
        $education = Education::find($id);
        $education->delete();
    }
}
