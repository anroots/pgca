<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\SummaryFiftyOrLessChars;
use Faker\Factory;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\SummaryFiftyOrLessChars
 */
class SummaryFiftyOrLessCharsTest extends AbstractRuleTest
{

    public function provideValidMessages()
    {
        $faker = Factory::create();

        return [
            [$faker->text(50)],
            [$faker->text(50)],
            [$faker->text(50)],
            [$faker->text(50)],
            [$faker->text(50)],
            [$faker->text(50)],
            ['Something short'],
            ['Something obviously of exact character length, huh'],
        ];
    }

    public function provideInvalidMessages()
    {
        $faker = Factory::create();
        $prefix = 'Something obviously of exact character length, huh';

        return [
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
        ];
    }

    protected function getRuleClass()
    {
        return SummaryFiftyOrLessChars::class;
    }
}
