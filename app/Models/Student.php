<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'dob',
        'level',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }


    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}
