<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\RuleInterface;
use Anroots\Pgca\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

abstract class AbstractRuleTest extends TestCase
{
    /**
     * @var RuleInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected $rule;

    public function setUp()
    {
        parent::setUp();
        $this->rule = $this->getMockBuilder($this->getRuleClass())
            ->setMethods(['addViolation'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    abstract public function provideInvalidMessages();

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

    abstract public function provideValidMessages();

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

    protected function commitFactory($message)
    {
        $commit = new Commit;
        $commit->setMessage($message);

        return $commit;
    }

    abstract protected function getRuleClass();

    protected function expectSuccess()
    {
        $this->rule->expects($this->never())
            ->method('addViolation');
    }

    protected function expectFailure()
    {
        $this->rule->expects($this->once())
            ->method('addViolation');
    }
}