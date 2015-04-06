<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;
use Anroots\Pgca\Rule\ViolationFactoryInterface;
use swearjar\Tester;

class ContainsProfanity extends AbstractRule
{
    /**
     * @var Tester
     */
    private $profanityChecker;

    /**
     * @param ViolationFactoryInterface $violationFactory
     */
    public function __construct(ViolationFactoryInterface $violationFactory, Tester $profanityChecker)
    {

        parent::__construct($violationFactory);
        $this->profanityChecker = $profanityChecker;
    }

    public function getName()
    {
        return 'message.containsProfanity';
    }

    public function getMessage()
    {
        return 'Message contains profanity';
    }

    protected function run(CommitInterface $commit)
    {
        if ($this->profanityChecker->profane($commit->getMessage())) {
            $this->addViolation($commit);
        }
    }
}