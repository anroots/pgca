<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\NoDoubleWhitespace;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\NoDoubleWhitespace
 */
class NoDoubleWhitespaceTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        return [
            ["Some test commit\n\nTest description\n\n  - list item one\n  - two\n\nSome text  oops, two spaces\nEnd"],
            ['Fix test  again'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function provideValidMessages()
    {
        return [
            ["Fix some magic that...\n  - happened between yesterday and today"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRuleClass()
    {
        return NoDoubleWhitespace::class;
    }
}
