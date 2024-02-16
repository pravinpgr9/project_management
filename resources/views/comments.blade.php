<!-- resources/views/comments.blade.php -->

@foreach ($comments as $comment)
    <div class="comment">
        <p>{{ $comment->body }}</p>
        <!-- Display files attached to this comment -->
        @foreach ($comment->files as $file)
            <p><a href="{{ asset($file->file_path) }}">{{ $file->file_name }}</a></p>
        @endforeach
        <!-- Display nested comments -->
        @include('comments', ['comments' => $comment->replies])
    </div>
@endforeach

<hr>

<!-- Form to add a new comment -->
<form action="{{ route('projects.tasks.comments.store', ['project' => $project->id, 'task' => $task->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="body">Comment:</label>
        <textarea name="body" id="body" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="file">Attach File:</label>
        <input type="file" name="file" id="file" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Add Comment</button>
</form>
