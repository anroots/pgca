<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class HasSummaryAndDescriptionRule extends AbstractRule
{
    protected $name = 'message.hasSummaryAndDescription';

    public function apply(CommitInterface $commit)
    {
        $this->addViolation($commit);
    }
}