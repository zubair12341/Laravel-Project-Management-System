<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function file()
    {
        return $this->hasMany(TaskCommentFile::class,'task_comment_id','id');
    }
}
