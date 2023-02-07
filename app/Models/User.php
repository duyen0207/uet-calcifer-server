<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'UserId';
    // public $incrementing = false;

    // protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'UserId',
        'UserName',
        'Password',
        'Role',
        'FullName',
        'Email',
        'DateOfBirth',
        'CourseClass',
        'CreatedTime',
        'CreatedBy',
        'ModifiedTime',
        'ModifiedBy',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    // relationship
    // 1-m
    function submissions()
    {
        return $this->hasMany(Submission::class, 'StudentId', 'UserId');
    }
    // m-n
    function practice_classes()
    {
        return $this->belongsToMany(PracticeClass::class, 'user_class', 'UserId', 'ClassId');
    }
}
