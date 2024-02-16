<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        // Eager load the 'files' relationship
        $tasks = $project->tasks()->with('files')->get();

        // echo "<pre>";
        // print_r($tasks->toArray());
        // print_r($project->toArray());
        // exit;

        // Initialize an array to store task images
        $taskImages = [];

        // Loop through each task to extract image paths
        foreach ($tasks as $task) {
            $images = [];

            // Extract file paths from files associated with the task
            foreach ($task->files as $file) {
                // Assuming you have a column named 'file_path' that holds the path to the image file
                $images[] = asset($file->file_path);
            }

            // Store the task ID and its associated images in the taskImages array
            $taskImages[$task->id] = $images;
        }

        // Pass the task images along with tasks and project to the view
        return view('tasks.index', compact('project', 'tasks', 'taskImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        $task = new Task($request->all());
        $task->project()->associate($project);
        
        // Associate the task with the authenticated user
        $task->user_id = auth()->id();

        $task->save();

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
{
    // Get all comments associated with the task
    $comments = $task->comments()->with('files')->get();

    // Delete associated files for each comment
    foreach ($comments as $comment) {
        foreach ($comment->files as $file) {
            if ($file->path && Storage::exists($file->path)) {
                Storage::delete($file->path);
            }
            $file->delete();
        }
    }

    // Delete the comments
    $task->comments()->delete();

    // Delete the task
    $task->delete();

    return redirect()->route('projects.tasks.index', $project)->with('success', 'Task deleted successfully.');
}


}
