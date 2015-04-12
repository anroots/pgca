<?php

namespace Anroots\Pgca\Rule\Message;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class NotTypicalNonsense extends AbstractRule
{
    private $vocabulary = [
        'bug fix',
        'fix bug',
        'minor change',
        'some brief changes',
        'lots and lots of changes',
        'lots of changes',
        'change some stuff',
        'change stuff',
        'refactoring',
        'minor update',
        'more work',
        'work on feature',
    ];

    const MATCH_THRESHOLD = 60.0;

    public function getName()
    {
        return 'message.notTypicalNonsense';
    }

    public function isConfigured()
    {
        return count($this->vocabulary) > 0;
    }

    /**
     * @param array $options
     */
    public function configure(array $options = [])
    {
        if (!array_key_exists('vocabulary', $options) || !is_array($options['vocabulary'])) {
            return;
        }

        $this->vocabulary = array_merge($this->vocabulary, $options['vocabulary']);
    }


    public function getMessage()
    {
        return 'Commit message does not provide any useful information';
    }

    protected function run(CommitInterface $commit)
    {
        foreach ($this->vocabulary as $nonsensePhrase) {
            $nonsensePhrase = mb_strtolower($nonsensePhrase);
            $message = mb_strtolower($commit->getMessage());

            if ($this->isMessageMostlyNonsense($message, $nonsensePhrase)) {
                $this->addViolation($commit);

                return;
            }
        }
    }

    private function isMessageMostlyNonsense($message, $nonsensePhrase)
    {
        if (stristr($message, $nonsensePhrase) && mb_strlen($message) <= mb_strlen($nonsensePhrase * 2)) {
            return true;
        }

        similar_text($nonsensePhrase, $message, $similarityPercentage);

        if ($similarityPercentage > self::MATCH_THRESHOLD) {
            return true;
        }

        return false;
    }
}
