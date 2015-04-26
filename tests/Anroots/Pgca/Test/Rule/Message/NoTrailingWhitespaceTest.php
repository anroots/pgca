<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\NoTrailingWhitespace;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\NoTrailingWhitespace
 */
class NoTrailingWhitespaceTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        return [
            ['Quake '],
            ["Max pain\n "],
            ["Test\nsad "],
            ["Test\n\n "],
            ["Test\n\nsad "],
            [' '],
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
        return NoTrailingWhitespace::class;
    }
}
