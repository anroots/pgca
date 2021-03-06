<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Git\CommitInterface;

interface ViolationInterface
{

    /**
     * @param CommitInterface $commit
     * @param RuleInterface $rule
     */
    public function __construct(CommitInterface $commit, RuleInterface $rule);

    /**
     * @return CommitInterface
     */
    public function getCommit();

    /**
     * @return RuleInterface
     */
    public function getRule();

    /**
     * @return array
     */
    public function toArray();
}
