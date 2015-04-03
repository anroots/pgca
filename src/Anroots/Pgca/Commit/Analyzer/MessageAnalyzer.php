<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\Git\CommitInterface;

class MessageAnalyzer extends AbstractAnalyzer
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

    public function getName()
    {
        return 'message';
    }
}