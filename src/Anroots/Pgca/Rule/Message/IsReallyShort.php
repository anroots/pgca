<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class IsReallyShort extends AbstractRule
{
    const MIN_LENGTH = 20;
    protected $name = 'message.isReallyShort';

    public function apply(CommitInterface $commit)
    {
        $messageLength = strlen($commit->getMessage());
        if ($messageLength < self::MIN_LENGTH) {
            $this->addViolation($commit);
        }
    }
}