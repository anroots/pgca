<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\ReportInterface;
use Anroots\Pgca\Rule\RuleInterface;
use Anroots\Pgca\Rule\ViolationInterface;

interface CommitAnalyzerInterface
{
    /**
     * @return void
     */
    public function run();

    /**
     * @param CommitProviderInterface $provider
     * @return $this
     */
    public function setCommitProvider(CommitProviderInterface $provider);

    /**
     * @param CommitInterface $commit
     * @return void
     */
    public function analyzeCommit(CommitInterface $commit);

    /**
     * @param RuleInterface[] $rules
     * @return $this
     */
    public function setRules(array $rules);

    /**
     * @return RuleInterface[]
     */
    public function getRules();

    /**
     * @param ViolationInterface $violation
     * @return $this
     */
    public function addViolation(ViolationInterface $violation);

    /**
     * @return ReportInterface
     */
    public function getReport();

    /**
     * @param ReportInterface $report
     * @return $this
     */
    public function setReport(ReportInterface $report);
}
