<?php


namespace Anroots\Pgca\Commit\Filter;

use Anroots\Pgca\Git\CommitInterface;

abstract class AbstractFilter implements FilterInterface
{


    public function configure(array $options)
    {

    }

    public function apply(CommitInterface $commit)
    {
        if (!$this->isConfigured()) {
            throw new FilterException(
                sprintf('Please provide all required configuration options to %s', get_class($this))
            );
        }

        return $this->isIncluded($commit);
    }

    abstract protected function isIncluded(CommitInterface $commit);

    protected function isConfigured()
    {
        return true;
    }
}