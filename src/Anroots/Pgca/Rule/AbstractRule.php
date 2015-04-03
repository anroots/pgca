<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\ReportInterface;

abstract class AbstractRule implements RuleInterface
{

    /**
     * @var CommitAnalyzerInterface
     */
    protected $analyzer;

    /**
     * @var ViolationFactoryInterface
     */
    private $violationFactory;

    protected $name;

    /**
     * @param ViolationFactoryInterface $violationFactory
     */
    public function __construct(ViolationFactoryInterface $violationFactory)
    {

        $this->violationFactory = $violationFactory;
    }

    public function addViolation(CommitInterface $commit)
    {

        $violation = $this->violationFactory->create($commit, $this);
        $this->analyzer->addViolation($violation);
    }

    /**
     * @return ReportInterface
     */
    public function getAnalyzer()
    {
        return $this->analyzer;
    }

    /**
     * @param CommitAnalyzerInterface $analyzer
     * @return $this
     */
    public function setAnalyzer(CommitAnalyzerInterface $analyzer)
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

}