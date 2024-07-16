<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'name',
        'employee_id',
        'role_id',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasAnyRole($role)
    {
        if($this->role()->whereIn('role_type', $role)->first()){
            return true;
        }
        return false;
    }

    public function hasRole($role)
    {
        if($this->role()->where('role_type', $role)->first()){
            return true;
        }
        return false;
    }
}
