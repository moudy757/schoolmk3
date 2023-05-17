<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dob',
        'level',
    ];

    protected $with = ['user'];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)
            ->withTimestamps()
            ->withPivot(['grade', 'student_name']);
    }
}
