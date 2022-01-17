<?php


namespace App\Exceptions\Api;


use App\Services\CommonService;
use App\Services\ConstantStatusService;
use Exception;
use Laravel\Passport\Http\Controllers\ConvertsPsrResponses;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Container\Container;
use Zend\Diactoros\Response as Psr7Response;
use Illuminate\Contracts\Debug\ExceptionHandler;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class HandleOAuthErrorsException
{
    use ConvertsPsrResponses;

    public function __construct()
    {
        $this->commonService = new CommonService();
    }

    /**
     * Perform the given callback with exception handling.
     *
     * @param  \Closure  $callback
     * @return \Illuminate\Http\Response
     */
    public function withErrorHandling($callback)
    {
        try {
            return $callback();
        } catch (OAuthServerException $e) {
            $this->exceptionHandler()->report($e);

            $error = $this->convertResponse(
                $e->generateHttpResponse(new Psr7Response)
            );
            $errorData = json_decode($error->getContent(),true);
            return $this->commonService->errorCustomError($errorData,null,ConstantStatusService::UNPROCESSABLEENTITY);

        } catch (Exception $e) {
            $this->exceptionHandler()->report($e);

            return new Response($e->getMessage(), 500);
        } catch (Throwable $e) {
            $this->exceptionHandler()->report(new FatalThrowableError($e));

            return new Response($e->getMessage(), 500);
        }
    }

    /**
     * Get the exception handler instance.
     *
     * @return \Illuminate\Contracts\Debug\ExceptionHandler
     */
    protected function exceptionHandler()
    {
        return Container::getInstance()->make(ExceptionHandler::class);
    }

}