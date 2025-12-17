<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'type', 'reference_id', 'approved_by', 'status'
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
