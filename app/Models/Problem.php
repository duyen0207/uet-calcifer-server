<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    protected $table = 'problem';
    protected $primaryKey = 'ProblemId';
    // public $incrementing = false;

    public $timestamps = false;
    // protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ProblemId',
        'ProblemTitle',
        'Tags',
        'ProblemContent',
        'NumberOfTestcase',
        'TestcaseScript',
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
    function testcases()
    {
        return $this->hasMany(Testcase::class, 'ProblemId', 'ProblemId');
    }
    // 1-m
    function exercises()
    {
        return $this->hasMany(Exercise::class, 'ProblemId', 'ProblemId');
    }
}
