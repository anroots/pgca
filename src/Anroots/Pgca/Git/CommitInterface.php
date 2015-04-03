<?php

namespace Anroots\Pgca\Git;

interface CommitInterface
{
    public function getHash();

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash($hash);

    public function getMessage();

    public function setMessage($message);
}