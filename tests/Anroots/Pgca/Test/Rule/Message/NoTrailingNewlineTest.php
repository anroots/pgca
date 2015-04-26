<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\NoTrailingNewline;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\NoTrailingNewline
 */
class NoTrailingNewlineTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        return [
            ["Max pain\n\n"],
            ["Test\nsad\n"],
            ["Test\n\n\n"],
            ["\n"],
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
        return NoTrailingNewline::class;
    }
}
