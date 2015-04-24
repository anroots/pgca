<?php

namespace Anroots\Pgca\Commit\Filter;

use Anroots\Pgca\Git\CommitInterface;

interface FilterInterface
{

    /**
     * @param CommitInterface $commit
     * @return bool True if the commit should be included
     */
    public function apply(CommitInterface $commit);

    /**
     * @param array $options
     * @return void
     */
    public function configure(array $options);
}
