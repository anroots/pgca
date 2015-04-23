<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Git\CommitInterface;

interface RuleInterface
{
    public function apply(CommitInterface $commit);

    public function addViolation(CommitInterface $commit);

    public function getAnalyzer();

    public function setAnalyzer(CommitAnalyzerInterface $analyzer);

    public function getName();

    public function configure(array $data);

    public function getMessage();

    public function toArray();

    public function getCategory();

    public function getSeverity();
}
