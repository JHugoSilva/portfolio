<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::paginate(1);
        return response()->json([
            'projects' => $projects
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->link = $request->link;

        if ($request->hasFile('image')) {
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            \request()->image->move(public_path('upload'), $file_name);
            $project->image = $file_name;
        }

        $project->save();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $project = Project::find($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->link = $request->link;

        if ($project->image != $request->image) {

            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $project->image;
            if (file_exists($image)) {
                @unlink($image);
            }

            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            \request()->image->move(public_path('upload'), $file_name);
            $project->image = $file_name;
        }

        $project->save();
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return response()->json([
            'project' => $project
        ]);
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
    }
}
