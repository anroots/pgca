<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class NoTrailingWhitespace extends AbstractRule
{

    public function getName()
    {
        return 'message.noTrailingWhitespace';
    }

    public function getMessage()
    {
        return 'Commit message has trailing whitespace at the end of a line';
    }

    protected function run(CommitInterface $commit)
    {
        $lines = preg_split('/\n/', $commit->getMessage());

        foreach ($lines as $line) {
            if (substr($line, -1) === ' ') {
                $this->addViolation($commit);

                return;
            }
        }
    }
}
