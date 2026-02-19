<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskReview extends Model
{
    protected $fillable = [
        'task_id',
        'reviewer_id',
        'action',
        'note',
    ];


    // Review belongs to Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Review made by Manager (User)
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}