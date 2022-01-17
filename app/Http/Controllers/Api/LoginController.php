<?php

namespace App\Http\Controllers\Api;
use App\Services\Api\UserService;
use App\Transformers\LoginTransformer;
use Illuminate\Http\Request;
use App\Exceptions\Api\HandleOAuthErrorsException;
use App\Services\CommonService;
use App\Services\ConstantApiMessageService;
use App\Transformers\UserTransformer;
use App\User;
use Config;
use DB;
use EkParser;
use Exception;
use Hash;
use Input;
use Illuminate\Validation\Factory as ValidationFactory;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use Validator;
use Zend\Diactoros\Response as Psr7Response;

class LoginController extends AccessTokenController
{


    protected $request;
    protected $apiController;

    protected $server;
    protected $validationFactory;
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(ServerRequestInterface $request, AuthorizationServer $server, ValidationFactory $validationFactory)
    {
        $this->serverRequest = $request;
        $this->apiUser = new User();
        $this->server = $server;
        $this->validationFactory = $validationFactory;
        $this->userService = new UserService();

        $this->commonService = new CommonService();
        $this->error = new HandleOAuthErrorsException();
    }


    public function register(Request $request)
    {


        $rules = Config::get("Validation.sign_up.validation_rules");

        $data = $request->all();

        $validator = $this->commonService->validatePayload($data, $rules);

        if ($validator !== null) {
            return $this->commonService->errorUnprocessableMultipleEntity($validator);
        }


        try {
            DB::beginTransaction();
            $user = $this->userService->store($data);
            DB::commit();
            return $this->commonService->respondWithItem($user, new UserTransformer(), 'users');

        } catch (Exception $e) {
            DB::rollback();
          return $this->commonService->errorUnprocessableSingleEntity(" User Is Inactive", "User Inactive", "User Is Inactive");
        }
    }


    public function login(Request $request)
    {
        $data =

        $data =$request->all();

//        if (isset($data['grant_type']) && $data['grant_type'] === 'refresh_token') {
//            $rules = Config::get("Validation.refresh_token.validation_rules");
//
//        } else {
//            $rules = Config::get("Validation.login.validation_rules");
//        }
//
//        $validator = $this->commonService->validatePayload($data, $rules);
//
//        if ($validator !== null) {
//
//            return $this->commonService->errorUnprocessableMultipleEntity($validator);
//        }



        $response = $this->error->withErrorHandling(function () use ($data)
        {
            return $this->server->respondToAccessTokenRequest($this->serverRequest->withParsedBody($data), new Psr7Response);

        });


        if ($response->getStatusCode() == 200) {
            $data = json_decode((string)$response->getBody(), true);

            return $this->commonService->respondWithItem($data, new LoginTransformer(), 'login');
        } else {


            return $response;
        }


    }




}
