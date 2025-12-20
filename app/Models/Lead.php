<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'source',
        'notes',
        'status',
        'created_by',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

}

