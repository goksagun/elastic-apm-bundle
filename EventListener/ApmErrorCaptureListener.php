<?php

namespace Goksagun\ElasticApmBundle\EventListener;

use Goksagun\ElasticApmBundle\Apm\ElasticApmAwareInterface;
use Goksagun\ElasticApmBundle\Apm\ElasticApmAwareTrait;
use Goksagun\ElasticApmBundle\Utils\StringHelper;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApmErrorCaptureListener implements ElasticApmAwareInterface, LoggerAwareInterface
{
    use ElasticApmAwareTrait, LoggerAwareTrait;

    public function onKernelException(ExceptionEvent $event)
    {
        $config = $this->apm->getConfig();

        $errors = $config->get('errors');

        if ($config->notEnabled() || !$errors['enabled']) {
            return;
        }

        $throwable = $event->getThrowable();

        if ($errors) {
            if ($excludedStatusCodes = $errors['exclude']['status_codes'] ?? []) {
                if (!$throwable instanceof HttpExceptionInterface) {
                    return;
                }

                foreach ($excludedStatusCodes as $excludedStatusCode) {
                    if (StringHelper::match($excludedStatusCode, $throwable->getStatusCode())) {
                        return;
                    }
                }
            }

            if ($excludedExceptions = $errors['exclude']['exceptions'] ?? []) {
                foreach ($excludedExceptions as $excludedException) {
                    if ($throwable instanceof $excludedException) {
                        return;
                    }
                }
            }
        }

        $this->apm->captureThrowable($throwable);

        if (null !== $this->logger) {
            $this->logger->info(sprintf('Errors captured for "%s"', $throwable->getTraceAsString()));
        }

        try {
            $this->apm->send();
            $sent = true;
        } catch (\Throwable $e) {
            $sent = false;
        }

        if (null !== $this->logger) {
            $this->logger->info(
                sprintf('Errors %s for "%s"', $sent ? 'sent' : 'not sent', $throwable->getTraceAsString())
            );
        }
    }
}
