<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

/**
 * {@inheritdoc}
 */
class StartsWithCapitalLetter extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.startsWithCapitalLetter';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'A commit message should start with a capital letter';
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        $firstLetter = substr($commit->getMessage(), 0, 1);
        if (!ctype_upper($firstLetter)) {
            $this->addViolation($commit);
        }
    }
}
