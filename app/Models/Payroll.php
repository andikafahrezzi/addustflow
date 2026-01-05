<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'period',
        'status',
        'generated_by',
        'approved_by',
        'approved_at',
    ];
    
     public function scopeForPeriod($query, $period)
    {
        return $query->where('period', $period);
    }
    
    // Method untuk cek apakah payroll sudah ada untuk periode tertentu
    public static function existsForPeriod($period, $excludeId = null)
    {
        $query = self::where('period', $period);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        return $query->exists();
    }
    
    // Method untuk mendapatkan payroll berdasarkan periode
    public static function getByPeriod($period)
    {
        return self::where('period', $period)->first();
    }
    public function items()
    {
        return $this->hasMany(PayrollItem::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
