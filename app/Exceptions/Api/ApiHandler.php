<?php


namespace App\Exceptions\Api;

use App\Exceptions\CustomException;
use App\Traits\Exception\ExceptionHandlerTrait;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\SeekException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiHandler
{
    use ExceptionHandlerTrait;

    public function handle(\Exception $exception)
    {

        if ($exception instanceof NotFoundHttpException) {
            return $this->handleException("Page not found!", 404, 'not_found');
        }
        if ($exception instanceof OAuthServerException) {
            return $this->handleException($exception->getMessage(), 401, 'Unauthenticated');
        }
        if ($exception instanceof UnsatisfiedDependencyException) {
            return $this->handleException($exception->getMessage(), 400, 'application_error');
        }
        if ($exception instanceof ModelNotFoundException) {
            return $this->handleException("Item not found!", 422, 'item_not_found');
        }
        if ($exception instanceof ClientException) {
            return $this->handleGuzzleException($exception);
        }
        if ($exception instanceof BadResponseException) {
            return $this->handleGuzzleException($exception);
        }
        if ($exception instanceof ConnectException) {
            return $this->handleGuzzleException($exception);
        }
        if ($exception instanceof RequestException) {
            return $this->handleGuzzleException($exception);
        }
        if ($exception instanceof SeekException) {
            return $this->handleGuzzleException($exception);
        }
        if ($exception instanceof TransferException) {
            return $this->handleGuzzleException($exception);
        }

        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
            $code = $code >= 400 ? $code : 400;
            return $this->handleException($exception->getMessage(), $code, 'server_error');
//            return response()->make(['message' => $exception->getMessage(),'line' => $exception->getLine(),'file' => $exception->getFile(),'code'=>$exception->getCode(),'trace'=>$exception->getTraceAsString() ],400);
        }

    }
}