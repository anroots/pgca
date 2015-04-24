<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

/**
 * {@inheritdoc}
 */
class OneBlankLineAfterSummary extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.oneBlankLineAfterSummary';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'There should be exactly one blank line after the summary line';
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        if (mb_strlen($commit->getDescription()) === 0) {
            return;
        }

        $pieces = preg_split("/\n\n/u", $commit->getMessage(), 2);

        if (count($pieces) !== 2 || substr($pieces[1], 0, 1) === "\n") {
            $this->addViolation($commit);
        }
    }
}
