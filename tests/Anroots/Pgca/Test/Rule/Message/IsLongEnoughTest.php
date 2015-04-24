<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\IsLongEnough;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\IsLongEnough
 */
class IsLongEnoughTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        return [
            [''],
            ['Fix test'],
            ['Do some magic']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function provideValidMessages()
    {
        return [
            ['Fix some magic that happened between yesterday and today'],
            ['Re-implement feature NGW-222. This was supposed to be done yesterday']
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRuleClass()
    {
        return IsLongEnough::class;
    }
}
