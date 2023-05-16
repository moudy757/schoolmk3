<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Providers\RouteServiceProvider;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login_id',
        'password_changed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $with = ['userable'];

    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

    public function userHome()
    {
        if ($this->hasRole(['super-admin', 'admin'])) {
            return RouteServiceProvider::ADMIN;
        } elseif ($this->hasRole('teacher')) {
            return RouteServiceProvider::TEACHER;
        } elseif ($this->hasRole('student')) {
            return RouteServiceProvider::STUDENT;
        }
    }

    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()
            ->where('name', 'like', '%' . $search . '%')
            // ->orWhere('login_id', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    }
}
