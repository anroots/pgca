<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Git\CommitInterface;

class ViolationFactory implements ViolationFactoryInterface
{
    public function create(CommitInterface $commit, RuleInterface $rule)
    {
        return new Violation($commit, $rule);
    }
}
