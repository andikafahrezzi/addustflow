<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'proposal_id', 'name', 'start_date', 'end_date', 'status'
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
