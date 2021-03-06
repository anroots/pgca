<?php

namespace Anroots\Pgca\Report\Composer;

/**
 * {@inheritdoc}
 */
class BlameReport extends AbstractComposer
{
    /**
     * {@inheritdoc}
     */
    protected function buildRows()
    {
        $violations = $this->getReport()->getViolations();

        $authors = [];

        foreach ($violations as $violation) {
            $authorName = $violation->getCommit()->getAuthorName();
            if (!array_key_exists($authorName, $authors)) {
                $authors[$authorName] = ['blame' => 0, 'percentage' => 0];
            }
            $authors[$authorName]['blame'] += $violation->getRule()->getSeverity();
        }

        $totalBlame = $this->getReport()->getScore();

        foreach ($authors as $authorName => $violation) {
            $this->getReportHeader()->addRow([
                $this->column($authorName, 'authorName', 'Author'),
                $this->column($violation['blame'], 'blame', 'Blame (high = bad)'),
                $this->column(round($violation['blame'] / $totalBlame * 100, 2), 'percentage', '%')
            ]);
        }

        return $this;
    }
}
