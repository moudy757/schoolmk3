<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dob',
    ];

    protected $with = ['user'];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'student_courses');
    }
}
