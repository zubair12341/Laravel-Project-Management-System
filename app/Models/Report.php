<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';

    protected $fillable = ['id', 'employee_id', 'project_id','date','progress','department_id'];
    

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
