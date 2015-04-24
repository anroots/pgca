<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Git\CommitInterface;

/**
 * {@inheritdoc}
 */
class ViolationFactory implements ViolationFactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function create(CommitInterface $commit, RuleInterface $rule)
    {
        return new Violation($commit, $rule);
    }
}
