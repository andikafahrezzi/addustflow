<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'project_id', 'description', 'amount', 'expense_date'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
