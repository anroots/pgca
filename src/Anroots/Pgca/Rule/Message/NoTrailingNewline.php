<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class NoTrailingNewline extends AbstractRule
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.noTrailingNewline';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'Commit message ends with a trailing line break';
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        $endsWithNewLine = preg_match("/\n$/", $commit->getMessage());

        if ($endsWithNewLine === 1) {
            $this->addViolation($commit);
        }
    }
}
