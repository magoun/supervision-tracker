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

    public function totals() {
        
        $groupTotal = $total = 0;

        foreach($this->sessions as $session) {
            $total += $session->duration;
            $groupTotal += $session->isGroup ? $session->duration : 0;
        }

        return [
            'Total Hours:' => round($total / 60, 1),
            'Group Hours:' => round($groupTotal / 60, 1),
            'Individual Hours:' => round(($total - $groupTotal) / 60, 1)
        ];
    }
}
