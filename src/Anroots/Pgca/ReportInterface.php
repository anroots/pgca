<?php

namespace Anroots\Pgca;

use Anroots\Pgca\Rule\ViolationInterface;

interface ReportInterface
{
    public function addViolation(ViolationInterface $violation);

    /**
     * @return ViolationInterface[]
     */
    public function getViolations();

    public function setViolations(array $violations);

    public function countViolations();

    public function getScore();
}
