<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\ContainsProfanity;
use Anroots\Pgca\Rule\ViolationFactory;
use swearjar\Tester;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\ContainsProfanity
 */
class ContainsProfanityTest extends AbstractRuleTest
{

    public function setUp()
    {
        parent::setUp();

        $violationFactory = $this->getMockBuilder(ViolationFactory::class)
            ->setMethods(['create'])
            ->getMock();

        $this->rule = $this->getMockBuilder($this->getRuleClass())
            ->setMethods(['addViolation'])
            ->setConstructorArgs([$violationFactory, new Tester])
            ->getMock();
    }

    protected function getRuleClass()
    {
        return ContainsProfanity::class;
    }

    /**
     * @return array
     */
    public function provideInvalidMessages()
    {
        return [
            ['url bar update shit'],
            ['Fixing this fucking rubbish'],
            ['Recovered a fucked up merge'],
            ['Fixed read, bitch'],
        ];
    }

    public function provideValidMessages()
    {
        return [
            ['This is it, Jimmy! We are going off the deep end!'],
            ["Fix some magic that...\n  - happened between yesterday and today"],
            ['So do you think he remembers me?']
        ];
    }
}
