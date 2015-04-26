<?php

namespace Anroots\Pgca\Commit\Provider;

use Anroots\Pgca\Commit\Filter\FilterInterface;
use Anroots\Pgca\Git\CommitInterface;

interface CommitProviderInterface
{
    /**
     * @return \Generator
     */
    public function getCommits();

    /**
     * @param FilterInterface[] $filters
     * @return $this
     */
    public function setFilters(array $filters);

    /**
     * @return FilterInterface[]
     */
    public function getFilters();

    /**
     * @param array $options
     * @return void
     */
    public function configure(array $options);

    /**
     * @return null|int
     */
    public function countTotal();

    /**
     * @return null|int
     */
    public function countAnalyzed();

    /**
     * @return null|int
     */
    public function countSkipped();

    /**
     * @param CommitInterface $commit
     * @return bool
     */
    public function skipCommit(CommitInterface $commit);
}
