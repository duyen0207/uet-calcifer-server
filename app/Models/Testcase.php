<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testcase extends Model
{
    use HasFactory;
    protected $table = 'testcase';
    protected $primaryKey = 'TestcaseId';
    public $incrementing = false;

    public $timestamps = false;
    // protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'TestcaseId',
        'ProblemId',
        'Order',
        'TestcaseDescript',
        'Score',
        'Hidden',
        'CreatedTime',
        'CreatedBy'
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
}
