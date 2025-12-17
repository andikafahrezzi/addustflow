<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company'
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
