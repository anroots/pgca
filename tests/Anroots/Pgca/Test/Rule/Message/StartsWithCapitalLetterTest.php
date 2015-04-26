<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\StartsWithCapitalLetter;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\StartsWithCapitalLetter
 */
class StartsWithCapitalLetterTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        return [
            ['some magic happened'],
            ["there is no boon\n\n\nOnly pain"],
            ['']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function provideValidMessages()
    {
        return [
            ['Fix some stuff'],
            ['API-777']
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRuleClass()
    {
        return StartsWithCapitalLetter::class;
    }
}
