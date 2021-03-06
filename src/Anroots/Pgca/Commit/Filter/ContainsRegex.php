<?php

namespace Anroots\Pgca\Commit\Filter;

use Anroots\Pgca\Git\CommitInterface;

/**
 * Skip commits that contain a RegEx expression
 */
class ContainsRegex extends AbstractFilter
{

    /**
     * @var string
     */
    private $pattern;

    /**
     * {@inheritdoc}
     */
    public function isConfigured()
    {
        return !empty($this->pattern);
    }

    /**
     * {@inheritdoc}
     */
    public function configure(array $options = [])
    {
        if (array_key_exists('pattern', $options)) {
            $this->pattern = $options['pattern'];
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function isIncluded(CommitInterface $commit)
    {

        return preg_match($this->pattern, $commit->getMessage()) === 1;
    }
}
