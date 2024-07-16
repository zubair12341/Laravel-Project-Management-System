<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayableExpance extends Model
{
    use HasFactory;

    protected $table = 'payable_expance';

    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


}
