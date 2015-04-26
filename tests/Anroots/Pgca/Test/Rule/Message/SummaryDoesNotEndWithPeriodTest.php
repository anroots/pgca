<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\SummaryDoesNotEndWithPeriod;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\SummaryDoesNotEndWithPeriod
 */
class SummaryDoesNotEndWithPeriodTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        return [
            ['Quake.'],
            ['Max pain.'],
            ['Test string .'],
            ['.']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function provideValidMessages()
    {
        return [
            ["Fix some stuff\n\nThen do more"],
            ["a\n\ntr"],
            ["Unreal\n\n\nTournament"],
            ["Summary line\n\nDescription first\n\nDescription\nTwo"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRuleClass()
    {
        return SummaryDoesNotEndWithPeriod::class;
    }
}
