<?php

namespace Anroots\Pgca\Git;

interface CommitInterface
{
    public function getHash();

    public function setHash($hash);
}