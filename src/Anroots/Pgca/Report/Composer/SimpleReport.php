<?php

namespace Anroots\Pgca\Report\Composer;

class SimpleReport extends AbstractComposer
{


    protected function buildRows()
    {
        $violations = $this->getReport()->getViolations();

        foreach ($violations as $violation) {
            $this->getReportHeader()->addRow([
                $this->column($violation->getCommit()->getShortHash(), 'shortHash', 'Commit'),
                $this->column($violation->getCommit()->getAuthorName(), 'authorName', 'Author'),
                $this->column(
                    $this->truncate($violation->getCommit()->getSummary(), 20),
                    'truncatedCommitMessage',
                    'Commit Message'
                ),
                $this->column($violation->getRule()->getMessage(), 'violationMessage', 'Explanation')
            ]);
        }

        return $this;
    }

    private function truncate($text, $limit = 50)
    {
        if (strlen($text) <= $limit) {
            return $text;
        }

        return trim(substr($text, 0, $limit)) . '...';
    }
}
