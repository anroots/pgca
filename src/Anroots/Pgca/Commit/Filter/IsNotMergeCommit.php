<?php

namespace Anroots\Pgca\Commit\Filter;

use Anroots\Pgca\Git\CommitInterface;

/**
 * Skip merge commits
 */
class IsNotMergeCommit extends AbstractFilter
{

    public function isIncluded(CommitInterface $commit)
    {
        // Extremely naive implementation. Probably needs improving.
        $firstCars = substr($commit->getMessage(), 0, 5);

        $keepThisCommit = !($firstCars === 'Merge');

        return $keepThisCommit;
    }
}