<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class AllLinesLessThanThresholdChars extends AbstractRule
{
    private $maxLength = self::DEFAULT_MAX_LENGTH;

    const DEFAULT_MAX_LENGTH = 72;

    public function getName()
    {
        return 'message.allLinesLessThanThreshold';
    }

    public function isConfigured()
    {
        return $this->maxLength > 0;
    }

    public function configure(array $options = [])
    {
        $this->maxLength = array_key_exists('max', $options) ? (int)$options['max'] : self::DEFAULT_MAX_LENGTH;
    }


    public function getMessage()
    {
        return 'No line should be longer than ' . $this->maxLength . ' characters';
    }

    protected function run(CommitInterface $commit)
    {
        $lines = preg_split("/\n/", $commit->getMessage());

        if (!count($lines)) {
            return;
        }
        foreach ($lines as $line) {
            if (mb_strlen($line) > $this->maxLength) {
                $this->addViolation($commit);
            }
        }
    }
}
