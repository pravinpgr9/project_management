<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;
use App\Models\File;

use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, $project_id, $task_id)
    {
        $request->validate([
            'body' => 'required|string',
            'file' => 'nullable|file|max:10240', // Max file size: 10MB
        ]);
    
        try {
            $task = Task::findOrFail($task_id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Task not found.');
        }
    
        // Check if the request contains a parent_id (for sub-comments)
        if ($request->has('parent_id')) {
            try {
                $parentComment = Comment::findOrFail($request->parent_id);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return back()->with('error', 'Parent comment not found.');
            }
            $comment = new Comment();
            $comment->body = $request->body;
            $comment->task_id = $task->id;
            $comment->user_id = auth()->id();
            $comment->parent_id = $parentComment->id; // Set the parent_id for the sub-comment
            $comment->save();
        } else {
            // Create a regular comment if there is no parent_id
            $comment = new Comment();
            $comment->body = $request->body;
            $comment->task_id = $task->id;
            $comment->user_id = auth()->id();
            $comment->save();
        } 
    
        // Store attached file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time().$file->getClientOriginalName(); // Get the original filename
            $path = $file->move(public_path('images'), $filename); // Move the file to the public/images directory
            $photo = '/images/'.$filename; // Update the file path
            
            $fileModel = new File();
            $fileModel->file_path = $photo; // Store only the filename
            $fileModel->task_id = $task->id;
            $fileModel->user_id = auth()->id();
            $fileModel->comment_id = $comment->id;
            $fileModel->save();
        }
    
        return back()->with('success', 'Comment added successfully.');
    }
    




    public function destroy($project_id, $task_id, Comment $comment)
    {
        // Delete associated files records
        $comment->files()->delete();

        // Delete sub-comments recursively
        foreach ($comment->subComments as $subComment) {
            $this->destroy($project_id, $task_id, $subComment);
        }

        // Delete the comment
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }

}
