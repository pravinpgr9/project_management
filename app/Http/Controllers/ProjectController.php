<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    public function index()
    {
        // Retrieve projects belonging to the currently authenticated user
        $user_id = Auth::id();
        $projects = Project::where('user_id', $user_id)->get(); 

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required',
        'description' => 'required',
        ]);

        // Get the ID of the currently authenticated user
        $user_id = Auth::id();  

        Project::create([
        'title' => $request->title,
        'description' => $request->description,
        'user_id' => $user_id,
    ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete files associated with comments under tasks of the project
        $project->tasks()->each(function ($task) {
            $task->comments()->each(function ($comment) {
                $comment->files()->delete();
            });
        });

        // Delete comments associated with tasks under the project
        $project->tasks()->each(function ($task) {
            $task->comments()->delete();
        });

        // Delete tasks associated with the project
        $project->tasks()->delete();

        // Delete the project
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }


}
