<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class HasSummaryAndDescription extends AbstractRule
{
    protected $name = 'message.hasSummaryAndDescription';
    protected $message = 'Missing description block';

    protected function run(CommitInterface $commit)
    {
        preg_match("/^(.+)\n\n./u", $commit->getMessage(),$matches);

        $hasNewLines = isset($matches[1]) && mb_strlen(trim($matches[1])) > 0;

        if (!$hasNewLines) {
            $this->addViolation($commit);
        }
    }
}