<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class NoTrailingNewline extends AbstractRule
{

    public function getName()
    {
        return 'message.noTrailingNewline';
    }

    public function getMessage()
    {
        return 'Commit message ends with a trailing line break';
    }

    protected function run(CommitInterface $commit)
    {
        $endsWithNewLine = preg_match("/\n$/", $commit->getMessage());

        if ($endsWithNewLine === 1) {
            $this->addViolation($commit);
        }
    }
}