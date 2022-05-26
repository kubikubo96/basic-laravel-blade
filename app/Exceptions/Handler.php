<?php

namespace App\Exceptions;

use App\Services\Debug\TelegramService;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $e)
    {
        $html = '<b>[Lỗi] : </b><code>' . $e->getMessage() . '</code>';
        $html .= '<b>[File] : </b><code>' . $e->getFile() . '</code>';
        $html .= '<b>[Line] : </b><code>' . $e->getLine() . '</code>';
        $html .= '<b>[Request] : </b><code>' . json_encode(request()->all()) . '</code>';
        $html .= '<b>[URL] : </b><a href="'. url()->full() .'">' . url()->full() . '</a>';
        TelegramService::sendMessage($html);

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
