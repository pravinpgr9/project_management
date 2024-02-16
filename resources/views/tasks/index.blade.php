@extends('auth.layouts')

@section('content')
    <div class="container p-4" style="background-color: #fff4ea; border-radius: 15px;;margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Tasks for Project: <h4>{{ $project->title }}</h4>
                    </div>

                    <div class="panel-body">
                        <!-- Display existing tasks -->
                        <ul class="list-group">
                            @foreach ($tasks as $task)
                                <li class="list-group-item">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>{{ $task->title }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>{{ $task->description }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Priority:</strong> {{ $task->priority }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong> {{ $task->status }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Deadline:</strong> {{ $task->deadline }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('projects.tasks.edit', ['project' => $project, 'task' => $task]) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form
                                        action="{{ route('projects.tasks.destroy', ['project' => $project, 'task' => $task]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                    </form>
                                    <!-- Button to show comment form -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="collapse"
                                        data-bs-target="#commentForm{{ $task->id }}" aria-expanded="false"
                                        aria-controls="commentForm{{ $task->id }}">Add Comment</button>

                                    <!-- Comment form -->
                                    <div id="commentForm{{ $task->id }}" class="collapse mt-3">
                                        <form
                                            action="{{ route('projects.tasks.comments.store', ['project' => $project->id, 'task' => $task->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="body">Comment:</label>
                                                <textarea name="body" id="body" class="form-control" rows="3"></textarea>
                                            </div>
                                            <br/>
                                            <!-- Add file input field -->
                                            <div class="form-group">
                                                <label for="file">Upload File:</label>
                                                <input type="file" name="file" id="file"
                                                    class="form-control-file">
                                            </div>
                                            <br/>
                                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                                        </form>
                                    </div>

                                    <!-- Display comments -->
                                    <ul class="list-group mt-3">
                                        @foreach ($task->comments as $comment)
                                            @if ($comment->parent_id === null)
                                                <li class="list-group-item">
                                                    <p>{{ $comment->body }}</p>
                                                    <!-- Display associated files if they exist -->
                                                    @if ($comment->files->isNotEmpty())
                                                    <div class="mt-3">
                                                        <h5>Attachment:</h5>
                                                        <div class="row">
                                                            @forelse ($comment->files as $file)
                                                                <div class="col-6 col-md-3 mb-3">
                                                                    <div style="border: 1px solid #ccc; padding: 5px; text-align: center;">
                                                                        @php
                                                                            $extension = pathinfo($file->file_path, PATHINFO_EXTENSION);
                                                                            $iconPath = 'icons/';
                                                                            switch ($extension) {
                                                                                case 'pdf':
                                                                                    $iconPath .= 'pdf.png';
                                                                                    break;
                                                                                case 'doc':
                                                                                case 'docx':
                                                                                    $iconPath .= 'doc.png';
                                                                                    break;
                                                                                case 'zip':
                                                                                    $iconPath .= 'zip.png';
                                                                                    break;
                                                                                case 'csv':
                                                                                    $iconPath .= 'csv.png';
                                                                                    break;
                                                                                case 'jpg':
                                                                                case 'jpeg':
                                                                                case 'png':
                                                                                case 'gif':
                                                                                    $iconPath .= 'image.png';
                                                                                    break;
                                                                                default:
                                                                                    $iconPath .= 'other.png';
                                                                                    break;
                                                                            }
                                                                        @endphp
                                                                        <a href="{{ asset($file->file_path) }}" target="_blank" rel="noopener noreferrer">
                                                                            <img src="{{ asset($iconPath) }}" alt="{{ $file->file_path }}" style="width: 50px; height: 50px; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px;">
                                                                        </a>
                                                                        <p style="margin-bottom: 0;">{{ basename($file->file_path) }}</p>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div class="col">
                                                                    No files attached
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                    
                @endif
                                                    <form
                                                        action="{{ route('projects.tasks.comments.destroy', ['project' => $project, 'task' => $task, 'comment' => $comment]) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                    </form>
                                                    <!-- Reply button -->
                                                    <button type="button" class="btn btn-info" data-bs-toggle="collapse"
                                                        data-bs-target="#replyForm{{ $comment->id }}" aria-expanded="false"
                                                        aria-controls="replyForm{{ $comment->id }}">Reply</button>
                                                    <!-- Reply form -->
                                                    <div id="replyForm{{ $comment->id }}" class="collapse mt-3">
                                                        <form
                                                            action="{{ route('projects.tasks.comments.store', ['project' => $project->id, 'task' => $task->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <!-- Add hidden input for parent_id -->
                                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                            <div class="form-group">
                                                                <label for="body">Reply:</label>
                                                                <textarea name="body" id="body" class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <br/>
                                                            <button type="submit" class="btn btn-primary">Submit Reply</button>
                                                        </form>
                                                    </div>
                                                    <!-- Sub-comments -->
                                                    @if ($comment->subComments->isNotEmpty())
                                                        <ul class="list-group mt-3">
                                                            @foreach ($comment->subComments as $subComment)
                                                                @if ($subComment->parent_id !== null)
                                                                    <li class="list-group-item ml-3">
                                                                        <p>{{ $subComment->body }}</p>
                                                                        <!-- Add delete button for sub-comments if needed -->
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    

                                </li>
                            @endforeach
                        </ul>
                        <hr />
                        <a href="{{ route('projects.index') }}" class="btn btn-primary">Back to Projects</a>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
