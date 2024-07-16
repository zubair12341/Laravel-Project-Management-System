<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'employee_id',
        'basic_monthly_pay',
        'hours_deduction',
        'payable_amount',
        'bonus',
        'total',
        'payment_method'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
