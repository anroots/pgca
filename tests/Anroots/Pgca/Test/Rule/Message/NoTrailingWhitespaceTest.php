<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\NoTrailingWhitespace;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\NoTrailingWhitespace
 */
class NoTrailingWhitespaceTest extends AbstractRuleTest
{

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

    public function provideValidMessages()
    {
        return [
            ["Fix some stuff\n\nThen do more"],
            ["a\n\ntr"],
            ["Unreal\n\n\nTournament"],
            ["Summary line\n\nDescription first\n\nDescription\nTwo"]
        ];
    }

    protected function getRuleClass()
    {
        return NoTrailingWhitespace::class;
    }
}
