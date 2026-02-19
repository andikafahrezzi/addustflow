<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'deadline',
        'status',
        'pr_link',
        'revision_count',
    ];

    // Task belongs to Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Task assigned to User (Staff)
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Task has many reviews (revision / approval history)
    public function reviews()
    {
        return $this->hasMany(TaskReview::class);
    }
}