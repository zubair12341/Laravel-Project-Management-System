<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocuments extends Model
{
    use HasFactory;

    protected $table = 'employee_documents';
    protected $fillable = ['employee_id', 'file'];

}
