<?php

namespace Anroots\Pgca;

use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
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
