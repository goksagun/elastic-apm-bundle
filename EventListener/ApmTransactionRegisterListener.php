<?php

namespace Chq81\ElasticApmBundle\EventListener;

use Chq81\ElasticApmBundle\Apm\ElasticApmAwareInterface;
use Chq81\ElasticApmBundle\Apm\ElasticApmAwareTrait;
use Chq81\ElasticApmBundle\Utils\RequestProcessor;
use Nipwaayoni\Exception\Transaction\DuplicateTransactionNameException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * This listener listens to kernel requests and sends them to the APM server.
 */
class ApmTransactionRegisterListener implements ElasticApmAwareInterface, LoggerAwareInterface, UserContextAwareInterface
{
    use ElasticApmAwareTrait, LoggerAwareTrait, UserContextAwareTrait;

    /**
     * @param RequestEvent $event
     * @return void
     */
    public function onKernelRequest(RequestEvent $event)
    {
        $config = $this->apm->getConfig();

        $transactions = $config->get('transactions');

        if (!$event->isMasterRequest() || $config->notEnabled() || !$transactions['enabled']) {
            return;
        }

        $context = [
            'user' => $this->getUserContext()
        ];

        try {
            $this->apm->startTransaction(
                $name = RequestProcessor::getTransactionName(
                    $event->getRequest()
                ),
                $context
            );
        } catch (DuplicateTransactionNameException $e) {
            return;
        }

        if (null !== $this->logger) {
            $this->logger->info(sprintf('Transaction started for "%s"', $name));
        }
    }
}
