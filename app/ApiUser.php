<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class ApiUser extends Authenticatable
{

    use HasApiTokens, Notifiable;
    protected $guarded=['id'];
}
