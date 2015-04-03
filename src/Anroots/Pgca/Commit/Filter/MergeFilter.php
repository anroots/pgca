<?php

namespace Anroots\Pgca\Commit\Filter;

use Anroots\Pgca\Git\CommitInterface;

/**
 * Skip merge commits
 */
class MergeFilter extends AbstractFilter
{

    public function apply(CommitInterface $commit)
    {
        // Extremely naive implementation. Probably needs improving.
        $firstCars = substr($commit->getMessage(), 0, 5);

        $keepThisCommit = !($firstCars === 'Merge');

        return $keepThisCommit;
    }
}