<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

/**
 * {@inheritdoc}
 */
class SummaryDoesNotEndWithPeriod extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.summaryDoesNotEndWithPeriod';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'The Summary line should not end with a period';
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        $endsWithPeriod = preg_match('/^.*\.$/u', $commit->getSummary()) === 1;

        if ($endsWithPeriod) {
            $this->addViolation($commit);
        }
    }
}
