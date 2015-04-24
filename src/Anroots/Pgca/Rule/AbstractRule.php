<?php

namespace Anroots\Pgca\Rule;

use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Commit\Analyzer\RuleException;
use Anroots\Pgca\ConfigurableEntity;
use Anroots\Pgca\Git\CommitInterface;

/**
 * {@inheritdoc}
 */
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

    /**
     * {@inheritdoc}
     */
    public function addViolation(CommitInterface $commit)
    {

        $violation = $this->violationFactory->create($commit, $this);
        $this->analyzer->addViolation($violation);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAnalyzer()
    {
        return $this->analyzer;
    }

    /**
     * {@inheritdoc}
     */
    public function setAnalyzer(CommitAnalyzerInterface $analyzer)
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getName();

    /**
     * {@inheritdoc}
     */
    abstract public function getMessage();

    /**
     * {@inheritdoc}
     */
    public function apply(CommitInterface $commit)
    {
        if (!$this->isConfigured()) {
            throw new RuleException(
                sprintf('Please provide all required configuration options to %s', get_class($this))
            );
        }

        $this->run($commit);
    }

    /**
     * @param CommitInterface $commit
     * @return void
     */
    abstract protected function run(CommitInterface $commit);

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'message' => $this->getMessage()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        // Naive implementation.
        // Something more sophisticated is needed when the rule categories expand.
        return strstr(get_class($this), '\Message\\') ? 'Message' : 'Content';
    }

    /**
     * {@inheritdoc}
     */
    public function getSeverity()
    {
        return 1;
    }
}
