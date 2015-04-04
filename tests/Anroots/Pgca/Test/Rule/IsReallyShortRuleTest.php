<?php

namespace Anroots\Pgca\Test\Rule;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\IsReallyShortRule;
use Anroots\Pgca\Rule\RuleInterface;
use Anroots\Pgca\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\IsReallyShortRule
 */
class IsReallyShortRuleTest extends TestCase
{
    /**
     * @var RuleInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $rule;

    public function setUp()
    {
        parent::setUp();
        $this->rule = $this->getMockBuilder(IsReallyShortRule::class)
            ->setMethods(['addViolation'])
            ->disableOriginalConstructor()
            ->getMock();

    }

    /**
     * @return array
     */
    public function provideShortMessages()
    {
        return [
            [''],
            ['Fix test'],
            ['Do some magic']
        ];
    }

    /**
     * @dataProvider provideShortMessages
     * @param string $message
     * @covers ::apply
     */
    public function testRuleFailsForShortMessages($message)
    {

        $this->rule->expects($this->once())
            ->method('addViolation');

        $commit = new Commit;
        $commit->setMessage($message);
        $this->rule->apply($commit);
    }

    public function provideLongMessages()
    {
        return [
            ['Fix some magic that happened between yesterday and today'],
            ['Re-implement feature NGW-222. This was supposed to be done yesterday']
        ];
    }

    /**
     * @covers ::apply
     * @dataProvider provideLongMessages
     * @param string $message
     */
    public function testRulePassesForLongEnoughMessages($message)
    {


        $this->rule->expects($this->never())
            ->method('addViolation');

        $commit = new Commit;
        $commit->setMessage($message);
        $this->rule->apply($commit);

    }
}