<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class HasSummaryAndDescription extends AbstractRule
{
    public function getName()
    {
        return 'message.hasSummaryAndDescription';
    }

    public function getMessage()
    {
        return 'Missing description block';
    }

    protected function run(CommitInterface $commit)
    {
        $hasSummary = mb_strlen($commit->getSummary()) > 0;
        $hasDescription = mb_strlen($commit->getDescription()) > 0;

        if (!$hasSummary || !$hasDescription) {
            $this->addViolation($commit);
        }
    }
}
