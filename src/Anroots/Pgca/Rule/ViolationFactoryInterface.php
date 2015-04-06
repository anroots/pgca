<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Git\CommitInterface;

interface ViolationFactoryInterface
{
    public function create(CommitInterface $commit, RuleInterface $rule);
}
