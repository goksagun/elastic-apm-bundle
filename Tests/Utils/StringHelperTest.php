<?php

namespace Chq81\ElasticApmBundle\Tests\Utils;

use Chq81\ElasticApmBundle\Utils\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    public function testMatch()
    {
        $haystack = 'Foo';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    public function testEndMatch()
    {
        $haystack = 'Fo*';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    public function testStartMatch()
    {
        $haystack = '*oo';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    public function testMiddleMatch()
    {
        $haystack = 'F*o';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    public function testComplexMatch()
    {
        $haystack = '*his *s a co**lex matc* text*';
        $needle = 'This is a complex match text.';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    public function testMiddleMatchOptionalDash()
    {
        $haystack = 'F#o';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle, '#');

        $this->assertTrue($expected);
    }

    public function testMiddleNotMatch()
    {
        $haystack = 'F*o';
        $needle = 'Foe';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertFalse($expected);
    }

    public function testComplexNotMatch()
    {
        $haystack = '*his *s a co**lex matc* text*';
        $needle = 'This in a complex match text.';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertFalse($expected);
    }

    public function testLengthNotMatch()
    {
        $haystack = '*his *s a co**lex matc* text*';
        $needle = 'This is a complex match text';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertFalse($expected);
    }
}
