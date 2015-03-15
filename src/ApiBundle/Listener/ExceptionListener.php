<?php


namespace ApiBundle\Listener;


use AppBundle\Exception\ZeniumException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'kernel.exception' => 'onZeniumException'
        ];
    }

    public function onZeniumException(GetResponseForExceptionEvent $exceptionWrapper)
    {
        if ($exceptionWrapper->getException() instanceof ZeniumException) {
            $exception = $exceptionWrapper->getException();

            $dataArray = [
                'message' => $exception->getMessage(),
                'code'    => $exception->getCode(),
            ];

            $extraInformation = $exception->getExtraInformation();
            if (!empty($extraInformation)) {
                $dataArray['extra'] = $extraInformation;
            }

            $exceptionWrapper->setResponse(new JsonResponse($dataArray, $exception->getCode()));
        }
    }

}
