<?php

namespace Anroots\Pgca\Commit\Provider;

use Anroots\Pgca\CollectionSetAwareInterface;
use Anroots\Pgca\Commit\Filter\FilterInterface;
use Anroots\Pgca\Git\Commit\FactoryInterface;
use Anroots\Pgca\Git\CommitInterface;

/**
 * {@inheritdoc}
 */
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


    protected $counters = [
        'analyzed' => 0,
        'skipped' => 0,
        'total' => 0
    ];

    /**
     * @param FactoryInterface $commitFactory
     */
    public function __construct(FactoryInterface $commitFactory)
    {
        $this->commitFactory = $commitFactory;
    }

    /**
     * {@inheritdoc}
     */
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
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * {@inheritdoc}
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCollection(array $collection)
    {
        return $this->setFilters($collection);
    }

    /**
     * {@inheritdoc}
     */
    public function countAnalyzed()
    {
        return $this->counters['analyzed'];
    }

    /**
     * {@inheritdoc}
     */
    public function countSkipped()
    {
        return $this->counters['skipped'];
    }

    /**
     * {@inheritdoc}
     */
    public function countTotal()
    {
        return $this->counters['total'];
    }
}
