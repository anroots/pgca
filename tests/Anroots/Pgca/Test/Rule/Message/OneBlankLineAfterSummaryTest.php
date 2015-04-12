<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\OneBlankLineAfterSummary;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\OneBlankLineAfterSummary
 */
class OneBlankLineAfterSummaryTest extends AbstractMessageTest
{
    protected function getRuleClass()
    {
        return OneBlankLineAfterSummary::class;
    }

    /**
     * @return array
     */
    public function provideInvalidMessages()
    {
        return [
            ["Do some magic\nsome more"],
            ["Do some magic\n\n\nsome more"],
            ["Do some magic\n\n\n\nsome more"],
        ];
    }

    public function provideValidMessages()
    {
        return [
            [''],
            ["Fix some magic that happened between\n\nyesterday and today"],
            ["Re-implement feature NGW-222.\n\nThis was supposed to be done yesterday"],
            ['Fix test'], // Has no description block, should pass
        ];
    }
}
