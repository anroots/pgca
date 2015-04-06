<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\IsTooShort;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\IsTooShort
 */
class IsTooShortTest extends AbstractRuleTest
{
    protected function getRuleClass()
    {
        return IsTooShort::class;
    }

    /**
     * @return array
     */
    public function provideInvalidMessages()
    {
        return [
            [''],
            ['Fix test'],
            ['Do some magic']
        ];
    }

    public function provideValidMessages()
    {
        return [
            ['Fix some magic that happened between yesterday and today'],
            ['Re-implement feature NGW-222. This was supposed to be done yesterday']
        ];
    }
}