<?php

namespace Anroots\Pgca\Report\Composer;

/**
 * {@inheritdoc}
 */
class FullReport extends AbstractComposer
{
    /**
     * {@inheritdoc}
     */
    protected function buildRows()
    {

        $violations = $this->getReport()->getViolations();

        foreach ($violations as $violation) {
            $this->getReportHeader()->addRow([
                $this->column($violation->getCommit()->getShortHash(), 'shortHash', 'Short Commit Hash'),
                $this->column($violation->getCommit()->getHash(), 'hash', 'Commit Hash'),
                $this->column($violation->getCommit()->getAuthorName(), 'authorName', 'Author Name'),
                $this->column($violation->getCommit()->getSummary(), 'commitSummary', 'Commit Summary Line'),
                $this->column($violation->getCommit()->getMessage(), 'commitMessage', 'Full Commit Message'),
                $this->column($violation->getRule()->getMessage(), 'ruleMessage', 'Explanation'),
                $this->column($violation->getRule()->getName(), 'ruleName', 'Rule Name')
            ]);
        }

        return $this;
    }
}
