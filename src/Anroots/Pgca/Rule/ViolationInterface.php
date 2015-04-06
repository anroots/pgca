<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Git\CommitInterface;

interface ViolationInterface
{
    public function __construct(CommitInterface $commit, RuleInterface $rule);

    /**
     * @return CommitInterface
     */
    public function getCommit();

    /**
     * @return RuleInterface
     */
    public function getRule();

    public function toArray();
}
