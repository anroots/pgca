<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;
use Anroots\Pgca\Rule\ViolationFactoryInterface;
use swearjar\Tester;

/**
 * {@inheritdoc}
 */
class NoProfanity extends AbstractRule
{
    /**
     * @var Tester
     */
    private $profanityChecker;

    private $message = 'Message contains profanity';

    /**
     * @param ViolationFactoryInterface $violationFactory
     * @param Tester $profanityChecker
     */
    public function __construct(ViolationFactoryInterface $violationFactory, Tester $profanityChecker)
    {

        parent::__construct($violationFactory);
        $this->profanityChecker = $profanityChecker;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.noProfanity';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        $profane = false;
        $message = null;

        $this->profanityChecker->scan($commit->getMessage(), function ($word, $types) use (&$profane, &$message) {
            $profane = true;

            $message = sprintf(
                'The word "%s" is considered profane (%s)',
                mb_strtolower($word),
                implode(',', $types)
            );

            return false;
        });

        if ($profane) {
            $this->message = $message;
            $this->addViolation($commit);
        }
    }
}
