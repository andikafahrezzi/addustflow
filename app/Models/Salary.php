<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee_id', 'amount', 'month', 'year'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
