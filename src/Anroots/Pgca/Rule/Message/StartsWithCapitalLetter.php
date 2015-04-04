<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class StartsWithCapitalLetter extends AbstractRule
{
    protected $name = 'message.startsWithCapitalLetter';
    protected $message = 'A commit message should start with a capital letter';
    protected function run(CommitInterface $commit)
    {
        $firstLetter = substr($commit->getMessage(), 0, 1);
        if (!ctype_upper($firstLetter)) {
            $this->addViolation($commit);
        }
    }
}