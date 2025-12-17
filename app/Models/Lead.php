<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'client_id', 'title', 'status', 'estimated_value'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
