<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Git\CommitInterface;

interface ViolationFactoryInterface
{
    /**
     * @param CommitInterface $commit
     * @param RuleInterface $rule
     * @return ViolationInterface
     */
    public function create(CommitInterface $commit, RuleInterface $rule);
}
