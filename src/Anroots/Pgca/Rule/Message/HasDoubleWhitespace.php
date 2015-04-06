<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class HasDoubleWhitespace extends AbstractRule
{

    public function getName()
    {
        return 'message.hasDoubleWhitespace';
    }

    public function getMessage()
    {
        return 'Double whitespace between words';
    }

    protected function run(CommitInterface $commit)
    {
        $hasDoubleWhitespace = preg_match('/\w  \w/', $commit->getMessage());
        if ($hasDoubleWhitespace) {
            $this->addViolation($commit);
        }
    }
}
