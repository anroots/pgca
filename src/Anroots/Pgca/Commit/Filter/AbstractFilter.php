<?php


namespace Anroots\Pgca\Commit\Filter;

use Anroots\Pgca\ConfigurableEntity;
use Anroots\Pgca\Git\CommitInterface;

abstract class AbstractFilter extends ConfigurableEntity implements FilterInterface
{


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

}