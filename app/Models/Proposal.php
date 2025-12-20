<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'title',
        'description',
        'estimated_value',
        'status',
        'approved_by',
        'approved_at',
    ];

    // Relasi ke lead
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    // Relasi ke user yang approve
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Relasi ke project
    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
