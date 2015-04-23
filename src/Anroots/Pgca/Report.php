<?php

namespace Anroots\Pgca;

use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\Rule\ViolationInterface;

class Report implements ReportInterface
{

    /**
     * @var ViolationInterface[]
     */
    protected $violations = [];

    /**
     * @var CommitProviderInterface
     */
    protected $provider;


    public function addViolation(ViolationInterface $violation)
    {
        $this->violations[] = $violation;
    }

    /**
     * @return Rule\ViolationInterface[]
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * @param Rule\ViolationInterface[] $violations
     * @return $this
     */
    public function setViolations(array $violations)
    {
        $this->violations = $violations;

        return $this;
    }

    public function countViolations()
    {
        return count($this->violations);
    }

    /**
     * {@inheritdoc}
     */
    public function getScore()
    {
        if ($this->countViolations() === 0) {
            return 0;
        }

        $sum = 0;
        foreach ($this->violations as $violation) {
            $sum += $violation->getRule()->getSeverity();
        }

        return $sum;
    }

    /**
     * {@inheritdoc}
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * {@inheritdoc}
     */
    public function setProvider(CommitProviderInterface $provider)
    {
        $this->provider = $provider;

        return $this;
    }
}
