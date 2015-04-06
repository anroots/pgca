<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\HasSummaryAndDescription;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\HasSummaryAndDescription
 */
class HasSummaryAndDescriptionTest extends AbstractRuleTest
{

    public function provideInvalidMessages()
    {
        return [
            ['Quake'],
            ["Max pain\n"],
            ["\n\nTest"],
            ['']
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
        return HasSummaryAndDescription::class;
    }
}
