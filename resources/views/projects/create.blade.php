<!-- resources/views/projects/create.blade.php -->

@extends('auth.layouts')

@section('content')
<div class="container p-4" style="background-color: #fff4ea; border-radius: 15px;;margin-top:20px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Create Project</h1>
                <hr/>
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
