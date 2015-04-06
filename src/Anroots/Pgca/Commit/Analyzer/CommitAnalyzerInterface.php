<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\ReportInterface;
use Anroots\Pgca\Rule\ViolationInterface;

interface CommitAnalyzerInterface
{
    /**
     * @return mixed
     */
    public function run();

    public function setCommitProvider(CommitProviderInterface $provider);

    public function analyzeCommit(CommitInterface $commit);

    public function setRules(array $rules);

    public function getRules();

    public function addViolation(ViolationInterface $violation);

    /**
     * @return ReportInterface
     */
    public function getReport();

    public function setReport(ReportInterface $report);
}
