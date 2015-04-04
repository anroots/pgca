<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class IsTooShort extends AbstractRule
{
    const MIN_LENGTH = 20;

    protected $name = 'message.isReallyShort';

    /**
     * @var int
     */
    private $minLength = self::MIN_LENGTH;

    public function configure(array $options = [])
    {
        $this->minLength = array_key_exists('min', $options) ? (int)$options['min'] : self::MIN_LENGTH;

    }

    public function isConfigured()
    {
        return $this->minLength > 0;
    }


    protected function run(CommitInterface $commit)
    {
        $messageLength = strlen($commit->getMessage());
        if ($messageLength < $this->minLength) {
            $this->addViolation($commit);
        }
    }
}