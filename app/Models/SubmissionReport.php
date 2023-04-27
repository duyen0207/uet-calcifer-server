<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class SubmissionReport extends Model
{
    use HasFactory;
    protected $table = 'submission_report';
    protected $primaryKey = 'SubmissionReportId';
    public $incrementing = false;


    public $timestamps = false;
    // protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'SubmissionReportId',
        'SubmissionId',
        'ErrorTestcaseOrder',
        'ErrorReport'
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

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->SubmissionReportId = (string) Uuid::generate(4);
        });
    }
}
