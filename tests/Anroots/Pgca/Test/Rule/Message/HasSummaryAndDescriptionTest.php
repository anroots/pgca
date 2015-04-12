<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\HasSummaryAndDescription;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\HasSummaryAndDescription
 */
class HasSummaryAndDescriptionTest extends AbstractMessageTest
{

    public function provideInvalidMessages()
    {
        return [
            ["Not forcing typehint and adding test to ensure URL and query string can be customized"],
            [
                "Preventing infinite recursion in Pool. When requests are intercepted in a Pool, it can result " .
                "in infinite recursion."
            ],
            [
                "Fixing typos in the FAQ. The extra trailing quote marks are unnecessary/invalid, and " .
                "break the syntax highlighting."
            ]
        ];
    }

    public function provideValidMessages()
    {
        return [
            [
                "Add editor config

Configure indent style and spaces across different editors. This should
make contributions a tiny bit easier."
            ],
            [
                "Correct typo in UPGRADING document

'Httl' => 'Http'"
            ],
            [
                "Updated the RequestFSM to use gotos.
- This commit updates the request FSM to use goto statements to reduce
  function call overhead and removes 5 stack frames from each request.
- Removed `finalState` from RequestFSM::__invoke
- Finishing FSM transitions is not handled in the FSM rather than the
  RingBridge.
- Slightly related to #964"
            ],
            ['Adding weird fix for #955'],
            ['Prevent pool recursion by detecting retries'],
            ['More consistent use of backticks'],
        ];
    }

    protected function getRuleClass()
    {
        return HasSummaryAndDescription::class;
    }
}
