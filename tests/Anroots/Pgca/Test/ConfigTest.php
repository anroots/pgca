<?php

namespace Anroots\Pgca\Test;

use Anroots\Pgca\Config;
use Anroots\Pgca\ConfigInterface;

/**
 * @coversDefaultClass \Anroots\Pgca\Config
 */
class ConfigTest extends TestCase
{

    /**
     * @var ConfigInterface
     */
    private $config;

    public function setUp()
    {
        parent::setUp();
        $this->config = new Config;
        $this->config->setPaths(['tests/stubs/config'])->load();
    }


    /**
     * @covers ::get
     */
    public function testGetReturnsVariableFromConfigFile()
    {
        $actual = $this->config->get('name');
        $this->assertSame('Orchestra', $actual);
    }

    /**
     * @covers ::get
     */
    public function testGetReturnsCorrectValueForDotNotationKey()
    {
        $actual = $this->config->get('ratings.skills.speed');

        $this->assertSame('high', $actual);
    }
}
