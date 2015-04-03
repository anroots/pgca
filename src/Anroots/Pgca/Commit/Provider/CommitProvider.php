<?php

namespace Anroots\Pgca\Commit\Provider;

interface CommitProviderInterface
{
    /**
     * @return \Generator
     */
    public function getCommits();
}