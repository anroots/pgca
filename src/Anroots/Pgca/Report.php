<?php

namespace Anroots\Pgca;

use Anroots\Pgca\Rule\ViolationInterface;

class Report implements ReportInterface
{

    /**
     * @var ViolationInterface[]
     */
    protected $violations = [];

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

    public function countViolations()
    {
        return count($this->violations);
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


}