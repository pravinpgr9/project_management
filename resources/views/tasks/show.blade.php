<!-- resources/views/tasks/show.blade.php -->

@extends('auth.layouts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Task Details</div>

                    <div class="panel-body">
                        <p><strong>Title:</strong> {{ $task->title }}</p>
                        <p><strong>Description:</strong> {{ $task->description }}</p>
                        <p><strong>Priority:</strong> {{ $task->priority }}</p>
                        <p><strong>Status:</strong> {{ $task->status }}</p>
                        <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
                        <a href="{{ route('projects.tasks.edit', ['project' => $project, 'task' => $task]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('projects.tasks.destroy', ['project' => $project, 'task' => $task]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                        <a href="{{ route('projects.index') }}" class="btn btn-default">Back to Projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
