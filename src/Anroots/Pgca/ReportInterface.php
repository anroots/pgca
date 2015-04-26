<?php

namespace Anroots\Pgca;

use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\Rule\ViolationInterface;

interface ReportInterface
{
    /**
     * @param ViolationInterface $violation
     * @return $this
     */
    public function addViolation(ViolationInterface $violation);

    /**
     * @return ViolationInterface[]
     */
    public function getViolations();

    /**
     * @param Rule\ViolationInterface[] $violations
     * @return $this
     */
    public function setViolations(array $violations);

    /**
     * @return int
     */
    public function countViolations();

    /**
     * @return int
     */
    public function getScore();

    /**
     * @param CommitProviderInterface $provider
     * @return $this
     */
    public function setProvider(CommitProviderInterface $provider);

    /**
     * @return CommitProviderInterface
     */
    public function getProvider();
}
