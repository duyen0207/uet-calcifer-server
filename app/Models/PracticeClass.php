<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class PracticeClass extends Model
{
    use HasFactory;
    protected $table = 'practice_class';
    protected $primaryKey = 'ClassId';
    public $incrementing = false;

    public $timestamps = false;
    // protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ClassId',
        'ClassCode',
        'ClassGroup',
        'Semester',
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
            $model->ClassId = (string) Uuid::generate(4);
        });
    }

    // relationship
    // m-n
    function users()
    {
        return $this->belongsToMany(User::class, 'user_class', 'ClassId', 'UserId');
    }
}
