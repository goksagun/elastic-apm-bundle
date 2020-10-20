<?php

namespace Chq81\ElasticApmBundle\EventListener;

use Chq81\ElasticApmBundle\Apm\ElasticApmAwareInterface;
use Chq81\ElasticApmBundle\Apm\ElasticApmAwareTrait;
use Chq81\ElasticApmBundle\Utils\RequestProcessor;
use Nipwaayoni\Exception\Transaction\UnknownTransactionException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\TerminateEvent;

/**
 * This listener listens to kernel terminations and sends them to the APM server.
 */
class ApmTransactionSenderListener implements ElasticApmAwareInterface, LoggerAwareInterface, UserContextAwareInterface
{
    use ElasticApmAwareTrait, LoggerAwareTrait, UserContextAwareTrait;

    /**
     * @param TerminateEvent $event
     * @return void
     */
    public function onKernelTerminate(TerminateEvent $event)
    {
        if (!$event->isMasterRequest() || $this->apm->getConfig()->notEnabled()) {
            return;
        }

        try {
            $transaction = $this->apm->getTransaction(
                $name = RequestProcessor::getTransactionName($event->getRequest())
            );
        } catch (UnknownTransactionException $e) {
            return;
        }

        $transaction->stop();

        $meta = $this->getMeta($event->getResponse());

        $transaction->setMeta($meta);

        if (null !== $this->logger) {
            $this->logger->info(sprintf('Transaction stopped for "%s"', $name));
        }

        $transaction->setUserContext($this->getUserContext());

        try {
            $this->apm->send();
        } catch (\Throwable $e) {
            $sent = false;
        }

        if (null !== $this->logger) {
            $this->logger->info(sprintf('Transaction %s for "%s"', $sent ? 'sent' : 'not sent', $name));
        }
    }

    private function getMeta(Response $response): array
    {
        $meta = [
            'result' => $response->getStatusCode(),
        ];

        return $meta;
    }
}
