<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\HasDoubleWhitespace;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\HasDoubleWhitespace
 */
class HasDoubleWhitespaceTest extends AbstractRuleTest
{
    protected function getRuleClass()
    {
        return HasDoubleWhitespace::class;
    }

    /**
     * @return array
     */
    public function provideInvalidMessages()
    {
        return [
            ["Some test commit\n\nTest description\n\n  - list item one\n  - two\n\nSome text  oops, two spaces\nEnd"],
            ['Fix test  again'],
        ];
    }

    public function provideValidMessages()
    {
        return [
            ["Fix some magic that...\n  - happened between yesterday and today"]
        ];
    }
}