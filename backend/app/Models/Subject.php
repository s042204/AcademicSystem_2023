<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    // public function students()
    // {
    //     return $this->belongsToMany(Student::class, 'student_subject');
    // }

    // public function teachers()
    // {
    //     return $this->belongsToMany(Teacher::class, 'subject_teacher');
    // }

    public function teachers()
    {
        return $this->hasMany(User::class, 'subject_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($group) {
            $group->students()->update(['subject_id' => null]);
        });
    }
}


