@extends('auth.layouts')

@section('content')
<div class="container p-4" style="background-color: #fff4ea; border-radius: 15px;;margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                <h1>My Projects</h1>
                <hr/>
                <a href="{{ route('projects.create') }}" class="btn btn-primary mb-2">Create Project</a>
                <hr/>
                
                @if ($projects->isEmpty())
                    <p>No projects found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>
                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                        </form>
                                        <!-- Button to create tasks for this project -->
                                        <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn btn-sm btn-success">Create Task</a>
                                        <!-- Button to view tasks for this project -->
                                        <a href="{{ route('projects.tasks.index', $project->id) }}" class="btn btn-sm btn-info">View Tasks</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
