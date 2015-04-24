<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

/**
 * {@inheritdoc}
 */
class NoTrailingWhitespace extends AbstractRule
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.noTrailingWhitespace';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'Commit message has trailing whitespace at the end of a line';
    }

    /**
     * {@inheritdoc}
     */
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
