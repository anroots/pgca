<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\CollectionSetAwareInterface;
use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\ReportInterface;
use Anroots\Pgca\Rule\RuleInterface;
use Anroots\Pgca\Rule\ViolationInterface;

class Analyzer implements CollectionSetAwareInterface, CommitAnalyzerInterface
{
    /**
     * @var CommitProviderInterface
     */
    protected $commitProvider;

    /**
     * @var RuleInterface[]
     */
    protected $rules;

    /**
     * @var ReportInterface
     */
    protected $report;

    /**
     * @param ReportInterface $report
     */
    public function __construct(ReportInterface $report)
    {
        $this->report = $report;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        if (!count($this->rules)) {
            throw new RuleException('No analyzer rules provided');
        }

        $commits = $this->commitProvider->getCommits();

        if (!$commits instanceof \Generator) {
            throw new \RuntimeException('Invalid output from the generator: check that getCommits() is a generator.');
        }

        foreach ($commits as $commit) {
            $this->analyzeCommit($commit);
        }
    }


    public function setCommitProvider(CommitProviderInterface $commitProvider)
    {
        $this->commitProvider = $commitProvider;

        return $this;
    }

    public function addViolation(ViolationInterface $violation)
    {
        $this->report->addViolation($violation);
    }

    /**
     * @return \Anroots\Pgca\Rule\RuleInterface[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param \Anroots\Pgca\Rule\RuleInterface[] $rules
     * @return $this
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param ReportInterface $report
     * @return $this
     */
    public function setReport(ReportInterface $report)
    {
        $this->report = $report;

        return $this;
    }

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
