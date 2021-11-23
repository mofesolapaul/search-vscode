<?php declare(strict_types=1);

namespace App\EventListener;

use App\Exception\ApiCallException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ArrayExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof ApiCallException) {
            return;
        }

        $event->setResponse(new JsonResponse(
            $exception->getMessage(),
            Response::HTTP_BAD_REQUEST
        ));
    }
}
