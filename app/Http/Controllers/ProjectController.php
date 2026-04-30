<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function indexSite()
    {
        $projects = Project::latest()->get();
        return response()->json([
            'projects' => $projects
        ]);
    }

    public function index()
    {
        $projects = Project::paginate(5);
        return response()->json([
            'projects' => $projects
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'longDescription' => 'required'
        ]);
        $project = new Project();
        $project->title = $request->title;
        $project->date = $request->publicationIn;
        $project->category = $request->category;
        $project->projectLink = $request->projectLink;
        $project->videoUrl = $request->videoUrl;
        $project->longDescription = $request->longDescription;

        if ($request->hasFile('image')) {
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            \request()->image->move(public_path('upload'), $file_name);
            $project->image = $file_name;
        }

        $project->save();
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'longDescription' => 'nullable|string',
            'category' => 'nullable|string',
            'date' => 'nullable|string',
            'videoUrl' => 'nullable|string',
            'projectLink' => 'nullable|string',
        ]);

        $project = Project::find($id);
        /** @var \App\Models\Project $project */
        $project->fill($validated);

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

    public function show($id)
    {
        $project = Project::where('id', $id)->first();
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
