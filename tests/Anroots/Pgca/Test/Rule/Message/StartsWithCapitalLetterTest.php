<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\StartsWithCapitalLetter;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\StartsWithCapitalLetter
 */
class StartsWithCapitalLetterTest extends AbstractRuleTest
{

    public function provideInvalidMessages()
    {
        return [
            ['some magic happened'],
            ["there is no boon\n\n\nOnly pain"],
            ['']
        ];
    }

    public function provideValidMessages()
    {
        return [
            ['Fix some stuff'],
            ['API-777']
        ];
    }

    protected function getRuleClass()
    {
        return StartsWithCapitalLetter::class;
    }
}