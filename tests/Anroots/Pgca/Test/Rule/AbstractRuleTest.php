<?php

namespace Anroots\Pgca\Test\Rule;

use Anroots\Pgca\Rule\RuleInterface;
use Anroots\Pgca\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

abstract class AbstractRuleTest extends TestCase
{
    /**
     * @var RuleInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected $rule;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->rule = $this->getMockBuilder($this->getRuleClass())
            ->setMethods(['addViolation'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return string
     */
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
