<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable
{
    use Notifiable;

    protected $table = 'agents';

    protected $guard = 'agent';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
