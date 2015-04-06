<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Commit\Analyzer\RuleException;
use Anroots\Pgca\ConfigurableEntity;
use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\ReportInterface;

abstract class AbstractRule extends ConfigurableEntity implements RuleInterface
{

    /**
     * @var CommitAnalyzerInterface
     */
    protected $analyzer;

    /**
     * @var ViolationFactoryInterface
     */
    private $violationFactory;

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

    abstract public function getName();

    abstract public function getMessage();

    public function apply(CommitInterface $commit)
    {
        if (!$this->isConfigured()) {
            throw new RuleException(
                sprintf('Please provide all required configuration options to %s', get_class($this))
            );
        }

        return $this->run($commit);
    }

    abstract protected function run(CommitInterface $commit);

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'message' => $this->getMessage()
        ];
    }
}
