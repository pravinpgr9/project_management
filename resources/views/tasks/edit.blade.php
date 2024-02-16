@extends('auth.layouts')

@section('content')
    <div class="container p-4" style="background-color: #fff4ea; border-radius: 15px;;margin-top:20px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Task for Project : <h4>{{ $project->title }}</h4>
                    </div>
                    <hr />
                    <div class="panel-body">
                        <form action="{{ route('projects.tasks.update', ['project' => $project, 'task' => $task]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $task->title }}" required>
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                            </div>
                            <br />

                            <div class="d-flex">
                                <div class="form-group" style="margin-left: 5px; margin-right: 5px;">
                                    <label for="priority">Priority</label>
                                    <select name="priority" id="priority" class="form-control" required>
                                        <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low
                                        </option>
                                        <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium
                                        </option>
                                        <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-left: 5px; margin-right: 5px;">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>
                                            In
                                            Progress</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-left: 5px; margin-right: 5px;">
                                    <label for="deadline">Deadline</label>
                                    <input type="datetime-local" name="deadline" id="deadline" class="form-control"
                                        value="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d\TH:i') : '' }}">
                                </div>
                            </div>
                            <br />
                            <button type="submit" class="btn btn-primary">Update Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
