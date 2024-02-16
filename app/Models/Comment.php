<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'task_id', 'parent_id', 'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    // Relationship for sub-comments (child comments)
    public function subComments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
