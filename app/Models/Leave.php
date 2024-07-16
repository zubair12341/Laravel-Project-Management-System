<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    // protected $fillable  = ['*'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
