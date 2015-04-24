<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class IsLongEnough extends AbstractRule
{
    const MIN_LENGTH = 20;


    /**
     * @var int
     */
    private $minLength = self::MIN_LENGTH;


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message.isLongEnough';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'Commit message is really short';
    }

    /**
     * {@inheritdoc}
     */
    public function configure(array $options = [])
    {
        $this->minLength = array_key_exists('min', $options) ? (int)$options['min'] : self::MIN_LENGTH;

    }

    /**
     * {@inheritdoc}
     */
    public function isConfigured()
    {
        return $this->minLength > 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        $messageLength = strlen($commit->getMessage());
        if ($messageLength < $this->minLength) {
            $this->addViolation($commit);
        }
    }
}
