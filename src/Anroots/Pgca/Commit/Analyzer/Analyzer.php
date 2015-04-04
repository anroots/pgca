<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\CollectionSetAwareInterface;
use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\RuleInterface;

class Analyzer extends AbstractAnalyzer implements CollectionSetAwareInterface
{

    /**
     * @return mixed
     */
    public function analyzeCommit(CommitInterface $commit)
    {

        foreach ($this->rules as $rule) {
            $rule->apply($commit);
        }
    }

    /**
     * @param RuleInterface[] $rules
     * @return $this
     */
    public function setCollection(array $rules)
    {
        foreach ($rules as $rule) {
            $rule->setAnalyzer($this);
        }

        return $this->setRules($rules);
    }
}