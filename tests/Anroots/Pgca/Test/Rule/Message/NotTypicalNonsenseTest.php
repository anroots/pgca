<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Rule\Message\NotTypicalNonsense;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\NotTypicalNonsense
 */
class NotTypicalNonsenseTest extends AbstractMessageTest
{
    /**
     * {@inheritdoc}
     */
    public function provideInvalidMessages()
    {
        return [
            ['Fix bug'],
            ['bug fix'],
            ['fix bug'],
            ['Fix random bug'],
            ['Do some work']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function provideValidMessages()
    {
        return [
            ['Create the PeopleParser class'],
            ['Fix bug where the Person could download File'],
            ['Implement feature NG222']
        ];
    }

    /**
     * @covers ::configure
     */
    public function testCustomVocabularyCanBeAdded()
    {
        $this->expectFailure();

        $this->rule->configure(['vocabulary' => ['Cars drive around the park']]);
        $commit = $this->commitFactory('Cars drive around the park');

        $this->rule->apply($commit);
    }

    /**
     * @return string
     */
    protected function getRuleClass()
    {
        return NotTypicalNonsense::class;
    }
}
