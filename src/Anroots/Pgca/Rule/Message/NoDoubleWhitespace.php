<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

/**
 * {@inheritdoc}
 */
class NoDoubleWhitespace extends AbstractRule
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.noDoubleWhitespace';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'Double whitespace between words';
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        $noDoubleWhitespace = preg_match('/\w  \w/', $commit->getMessage());
        if ($noDoubleWhitespace) {
            $this->addViolation($commit);
        }
    }
}
