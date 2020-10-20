<?php

namespace Chq81\ElasticApmBundle\Tests\Utils;

use Chq81\ElasticApmBundle\Utils\RequestProcessor;
use Chq81\ElasticApmBundle\Utils\StringHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * @coversDefaultClass \Chq81\ElasticApmBundle\Utils\RequestProcessor
 */
class RequestProcessorTest extends TestCase
{
    /**
     * @covers ::getTransactionName
     *
     * @return void
     */
    public function testGetTransactionName()
    {
        $request = new Request(
            [],
            [],
            [
                '_route' => 'Route',
                '_controller' => 'ControllerName'
            ]
        );

        $expected = RequestProcessor::getTransactionName($request);

        $this->assertEquals($expected, 'ControllerName (Route)');
    }
}
