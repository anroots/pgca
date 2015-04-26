<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\SummaryFiftyOrLessChars;
use Faker\Factory;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\SummaryFiftyOrLessChars
 */
class SummaryFiftyOrLessCharsTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideValidMessages()
    {
        $faker = $this->getFaker();

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

    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        $faker = $this->getFaker();
        $prefix = 'Something obviously of exact character length, huh';

        return [
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
            [$prefix . $faker->text(100)],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRuleClass()
    {
        return SummaryFiftyOrLessChars::class;
    }
}
