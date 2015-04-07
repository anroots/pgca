<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class SummaryDoesNotEndWithPeriod extends AbstractRule
{
    public function getName()
    {
        return 'message.summaryDoesNotEndWithPeriod';
    }

    public function getMessage()
    {
        return 'The Summary line should not end with a period';
    }

    protected function run(CommitInterface $commit)
    {
        $endsWithPeriod = preg_match('/^.*\.$/u', $commit->getSummary()) === 1;

        if ($endsWithPeriod) {
            $this->addViolation($commit);
        }
    }
}
