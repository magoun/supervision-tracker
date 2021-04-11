<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sessions() {
        return $this->hasMany(Session::class)->orderBy('date', 'desc');
    }

    public function firstSession() {
        return $this->sessions->last() ?? new Session;
    }

    public function totalHours() {
        return round($this->sessions->sum('duration') / 60, 1);
    }

    public function groupHours() {
        return round($this->sessions->where('isGroup')->sum('duration') / 60, 1);
    }

}
