<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class HasSummaryAndDescription extends AbstractRule
{
    protected $name = 'message.hasSummaryAndDescription';

    protected function run(CommitInterface $commit)
    {
        if (!strstr($commit->getMessage(),"\n\n")) {
            $this->addViolation($commit);
        }
    }
}