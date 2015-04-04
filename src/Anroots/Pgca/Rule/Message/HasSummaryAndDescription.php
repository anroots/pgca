<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class HasSummaryAndDescription extends AbstractRule
{
    protected $name = 'message.hasSummaryAndDescription';
    protected $message = 'Commit message should have both the summary and description blocks';

    protected function run(CommitInterface $commit)
    {
        $hasNewLines = preg_match("/\n\n/", $commit->getMessage()) === 1;
        if (!$hasNewLines) {
            $this->addViolation($commit);
        }
    }
}