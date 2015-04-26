<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Git\CommitInterface;

/**
 * {@inheritdoc}
 */
class Violation implements ViolationInterface
{

    /**
     * @var CommitInterface
     */
    private $commit;
    /**
     * @var RuleInterface
     */
    private $rule;

    /**
     * {@inheritdoc}
     */
    public function __construct(CommitInterface $commit, RuleInterface $rule)
    {

        $this->commit = $commit;
        $this->rule = $rule;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return [
            'commit' => $this->getCommit()->toArray(),
            'rule' => $this->getRule()->toArray()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getCommit()
    {
        return $this->commit;
    }

    /**
     * {@inheritdoc}
     */
    public function getRule()
    {
        return $this->rule;
    }
}
