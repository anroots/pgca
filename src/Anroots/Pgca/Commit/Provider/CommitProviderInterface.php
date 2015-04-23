<?php

namespace Anroots\Pgca\Commit\Provider;

interface CommitProviderInterface
{
    /**
     * @return \Generator
     */
    public function getCommits();

    public function setFilters(array $filters);

    public function getFilters();

    public function configure(array $options);

    public function countTotal();

    public function countAnalyzed();

    public function countSkipped();
}
