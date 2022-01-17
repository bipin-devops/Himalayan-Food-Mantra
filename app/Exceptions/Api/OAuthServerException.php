<?php
/**
 * Created by PhpStorm.
 * User: samina-mac-mini
 * Date: 3/23/18
 * Time: 1:49 PM
 */

namespace App\Exceptions\Api;


class OAuthServerException extends \League\OAuth2\Server\Exception\OAuthServerException
{

    public static function tooManyAttempt($seconds)
    {
        return new static('Too many login attempts. Please try again in '.$seconds.' seconds.', 6, 'too-many-attempt', 403);
    }
}