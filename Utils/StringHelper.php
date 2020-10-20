<?php

namespace Goksagun\ElasticApmBundle\Utils;

class StringHelper
{
    /**
     *
     *
     * @param $haystack
     * @param $needle
     * @param string $dash
     * @return bool
     */
    public static function match($haystack, $needle, $dash = '*')
    {
        $haystack = (string)$haystack;
        $needle = (string)$needle;

        if (strlen($haystack) !== strlen($needle)) {
            return false;
        }

        for ($i = 0; $i < strlen($haystack); $i++) {
            if ($haystack[$i] != $dash) {
                if ($haystack[$i] !== $needle[$i]) {
                    return false;
                }
            }
        }

        return true;
    }
}
