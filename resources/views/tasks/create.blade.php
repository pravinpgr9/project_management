<!-- resources/views/tasks/create.blade.php -->

@extends('auth.layouts')

@section('content')
    <div class="container p-4" style="background-color: #fff4ea; border-radius: 15px;;margin-top:20px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="panel panel-default">
                    <h4>Create Task for : {{ $project->title }}</h4>
                    <hr />

                    <div class="panel-body">
                        <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>
                            <br />
                            <div class="d-flex">
                                <div class="form-group" style="margin-left: 5px; margin-right: 5px;">
                                    <label for="priority" class="mr-2">Priority</label>
                                    <select name="priority" id="priority" class="form-control" required>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-left: 5px; margin-right: 5px;">
                                    <label for="status" class="mr-2">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-left: 5px; margin-right: 5px;">
                                    <label for="deadline" class="mr-2">Deadline</label>
                                    <input type="datetime-local" name="deadline" id="deadline" class="form-control">
                                </div>
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-primary">Create Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
