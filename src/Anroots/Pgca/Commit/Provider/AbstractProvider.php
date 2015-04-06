<?php

namespace Anroots\Pgca\Commit\Provider;

use Anroots\Pgca\CollectionSetAwareInterface;
use Anroots\Pgca\Commit\Filter\FilterInterface;
use Anroots\Pgca\Git\Commit\FactoryInterface;
use Anroots\Pgca\Git\CommitInterface;

abstract class AbstractProvider implements CommitProviderInterface, CollectionSetAwareInterface
{

    /**
     * @var FactoryInterface
     */
    protected $commitFactory;

    /**
     * @var FilterInterface[]
     */
    protected $filters;

    /**
     * @param FactoryInterface $commitFactory
     */
    public function __construct(FactoryInterface $commitFactory)
    {
        $this->commitFactory = $commitFactory;
    }

    public function skipCommit(CommitInterface $commit)
    {
        if (!count($this->filters)) {
            return false;
        }

        foreach ($this->filters as $filter) {
            if ($filter->apply($commit) === false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return FilterInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param FilterInterface[] $filters
     * @return $this
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;

        return $this;
    }


    public function setCollection(array $collection)
    {
        return $this->setFilters($collection);
    }
}