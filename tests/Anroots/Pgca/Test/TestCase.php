<?php

namespace Anroots\Pgca\Test;

use Faker\Factory;
use Faker\Generator;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Generator
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getFaker()
    {
        return Factory::create();
    }
}
