<?php

namespace Anroots\Pgca\Commit\Filter;

use Anroots\Pgca\Git\CommitInterface;

interface FilterInterface
{
    public function apply(CommitInterface $commit);
    public function configure(array $options);
}