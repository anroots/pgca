<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class SummaryFiftyOrLessChars extends AbstractRule
{
    protected $name = 'message.summaryFiftyOrLessChars';
    protected $message = 'The Summary line should be 50 or less characters';

    protected function run(CommitInterface $commit)
    {
        if (mb_strlen($commit->getSummary()) > 50) {
            $this->addViolation($commit);
        }
    }
}