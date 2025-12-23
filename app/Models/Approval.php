<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
            'approvable_type',
            'approvable_id',
            'status',
            'approved_by' ,
            'approved_at',
            'note',
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
