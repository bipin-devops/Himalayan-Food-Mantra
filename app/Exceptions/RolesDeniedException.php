<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class RolesDeniedException extends AuthorizationException
{
    //
    public function __construct($roles)
    {
        $this->message = sprintf("You don't have a required ['%s'] role.", implode('|', $roles));
        $this->code    = 401;
    }

}
