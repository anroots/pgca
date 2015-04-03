<?php

namespace Anroots\Pgca\Git;

class Commit implements CommitInterface
{

    private $hash;

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }
}