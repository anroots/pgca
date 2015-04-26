<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Test\Rule\AbstractRuleTest;

abstract class AbstractMessageTest extends AbstractRuleTest
{

    /**
     * @return array
     */
    abstract public function provideInvalidMessages();

    /**
     * @return array
     */
    abstract public function provideValidMessages();

    /**
     * @dataProvider provideInvalidMessages
     * @param string $message
     * @covers ::run
     */
    public function testRuleFailsForInvalidMessages($message)
    {

        $this->expectFailure();

        $commit = $this->commitFactory($message);
        $this->rule->apply($commit);
    }

    /**
     * @param $message
     * @return Commit
     */
    protected function commitFactory($message)
    {
        $commit = new Commit;
        $commit->setMessage($message);

        return $commit;
    }

    /**
     * @covers ::run
     * @dataProvider provideValidMessages
     * @param string $message
     */
    public function testRulePassesForValidMessages($message)
    {
        $this->expectSuccess();

        $commit = $this->commitFactory($message);
        $this->rule->apply($commit);
    }
}
