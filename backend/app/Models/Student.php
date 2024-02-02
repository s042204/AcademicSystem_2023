<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'student_number',
        'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
