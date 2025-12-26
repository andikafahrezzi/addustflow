<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'role'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
