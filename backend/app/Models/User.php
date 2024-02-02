<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'surname',
        'username',
        'password',
        'role', // admin, teacher, student
        'subject_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Automatically hash the password when it is set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    // Define a many-to-many relationship with Group
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    // Define a one-to-many inverse relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Define a one-to-many relationship with Grade
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    // For Passport or API authentication
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
