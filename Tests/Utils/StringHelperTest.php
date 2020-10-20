<?php

namespace Chq81\ElasticApmBundle\Tests\Utils;

use Chq81\ElasticApmBundle\Utils\StringHelper;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Chq81\ElasticApmBundle\Utils\StringHelper
 */
class StringHelperTest extends TestCase
{
    /**
     * @covers ::match
     *
     * @return void
     */
    public function testMatch()
    {
        $haystack = 'Foo';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testEndMatch()
    {
        $haystack = 'Fo*';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testStartMatch()
    {
        $haystack = '*oo';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testMiddleMatch()
    {
        $haystack = 'F*o';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testComplexMatch()
    {
        $haystack = '*his *s a co**lex matc* text*';
        $needle = 'This is a complex match text.';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertTrue($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testMiddleMatchOptionalDash()
    {
        $haystack = 'F#o';
        $needle = 'Foo';

        $expected = StringHelper::match($haystack, $needle, '#');

        $this->assertTrue($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testMiddleNotMatch()
    {
        $haystack = 'F*o';
        $needle = 'Foe';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertFalse($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testComplexNotMatch()
    {
        $haystack = '*his *s a co**lex matc* text*';
        $needle = 'This in a complex match text.';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertFalse($expected);
    }

    /**
     * @covers ::match
     *
     * @return void
     */
    public function testLengthNotMatch()
    {
        $haystack = '*his *s a co**lex matc* text*';
        $needle = 'This is a complex match text';

        $expected = StringHelper::match($haystack, $needle);

        $this->assertFalse($expected);
    }
}
