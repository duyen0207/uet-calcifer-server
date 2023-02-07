<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $table = 'exercise';
    protected $primaryKey = 'ExerciseId';
    public $incrementing = false;


    public $timestamps = false;
    // protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ExerciseId',
        'ProblemId',
        'ClassId',
        'OpenTime',
        'CloseTime',
        'MaxSubmissions',
        'ExerciseType',
        'CreatedTime',
        'CreatedBy',
        'ModifiedTime',
        'ModifiedBy'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

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
        return $this->hasMany(Submission::class, 'ExerciseId', 'ExerciseId');
    }
}
