<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function task_attachment()
    {
        return $this->hasManyThrough('App\Models\TaskAttachment', 'App\Models\Task');
    }
    public function payables()
    {
        return $this->hasMany(Project::class);
    }

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'lead_id');
    }

    public function sale()
    {
        return $this->hasOne(User::class, 'id', 'creater_id');
    }

}
