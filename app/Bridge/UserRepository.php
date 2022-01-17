<?php

namespace App\Bridge;

use App\Services\CommonService;
use App\Services\ConstantApiMessageService;
use App\Services\ConstantStatusService;
use Illuminate\Contracts\Hashing\Hasher;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use RuntimeException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Contracts\Hashing\Hasher $hasher
     * @return void
     */
    public function __construct(Hasher $hasher)
    {
        $this->commonService = new CommonService();
        $this->hasher = $hasher;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {

dd(123);

        $provider = config('auth.guards.api.provider');

        if (is_null($model = config('auth.providers.' . $provider . '.model'))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }

        if (method_exists($model, 'findForPassport')) {
            $user = (new $model)->findForPassport($username);
        } else {

            $user = (new $model)->where('email', $username)->orWhere('username',$username)->first();
        }





        if (!$user) {
            return;
        }


        if (method_exists($user, 'validateForPassportPasswordGrant')) {

            if (!$user->validateForPassportPasswordGrant($password)) {

                return;
            }
        } elseif (!$this->hasher->check($password, $user->getAuthPassword())) {
            return;
        }

        $userClientID = $user->clients()->pluck('id')->toArray();
        $clientId = $clientEntity->getIdentifier();

        if (!in_array($clientId, $userClientID)) {
            throw  OAuthServerException::invalidScope('scope');
        }

        return new User($user->getAuthIdentifier());
    }
}
