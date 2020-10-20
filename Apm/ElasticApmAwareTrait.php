<?php

namespace Chq81\ElasticApmBundle\Apm;

use Nipwaayoni\Agent;

/**
 * This trait provides the constructor for all services making use of the APM agent.
 */
trait ElasticApmAwareTrait
{
    /**
     * @var Agent
     */
    protected $apm;

    /**
     * @param Agent $apm
     */
    public function __construct(Agent $apm)
    {
        $this->apm = $apm;
    }
}
