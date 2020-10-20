<?php

namespace Goksagun\ElasticApmBundle\Apm;

use Nipwaayoni\Agent;

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
