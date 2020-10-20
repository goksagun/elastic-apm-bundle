<?php

namespace Chq81\ElasticApmBundle\Utils;

use Symfony\Component\HttpFoundation\Request;

/**
 * This class provides helper functions for requests.
 */
class RequestProcessor
{
    /**
     * Retrieves the transaction name.
     *
     * @param Request $request
     * @return string
     */
    public static function getTransactionName(Request $request): string
    {
        $routeName = $request->get('_route');
        $controllerName = $request->get('_controller');

        return sprintf('%s (%s)', $controllerName, $routeName);
    }
}
