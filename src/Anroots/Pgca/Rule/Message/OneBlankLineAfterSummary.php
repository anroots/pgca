<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class OneBlankLineAfterSummary extends AbstractRule
{
    protected $name = 'message.oneBlankLineAfterSummary';
    protected $message = 'There should be exactly one blank line after the summary line';

    protected function run(CommitInterface $commit)
    {
        $pieces = preg_split("/\n\n/u", $commit->getMessage(), 2);

        if (count($pieces) !== 2 || substr($pieces[1], 0, 1) === "\n") {
            $this->addViolation($commit);
        }
    }
}