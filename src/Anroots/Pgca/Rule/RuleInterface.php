<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Git\CommitInterface;

interface RuleInterface
{

    /**
     * @param CommitInterface $commit
     * @return void
     */
    public function apply(CommitInterface $commit);

    /**
     * @param CommitInterface $commit
     * @return $this
     */
    public function addViolation(CommitInterface $commit);

    /**
     * @return CommitAnalyzerInterface
     */
    public function getAnalyzer();

    /**
     * @param CommitAnalyzerInterface $analyzer
     * @return $this
     */
    public function setAnalyzer(CommitAnalyzerInterface $analyzer);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param array $data
     * @return void
     */
    public function configure(array $data);

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return array
     */
    public function toArray();

    /**
     * @return string
     */
    public function getCategory();

    /**
     * @return int
     */
    public function getSeverity();
}
