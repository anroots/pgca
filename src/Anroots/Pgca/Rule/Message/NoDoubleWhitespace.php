<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class NoDoubleWhitespace extends AbstractRule
{

    public function getName()
    {
        return 'message.noDoubleWhitespace';
    }

    public function getMessage()
    {
        return 'Double whitespace between words';
    }

    protected function run(CommitInterface $commit)
    {
        $NoDoubleWhitespace = preg_match('/\w  \w/', $commit->getMessage());
        if ($NoDoubleWhitespace) {
            $this->addViolation($commit);
        }
    }
}
