<?php

namespace Anroots\Pgca\Git;

interface CommitInterface
{
    public function getHash();
    public function getShortHash();
    public function setShortHash($hash);

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash($hash);

    public function getMessage();

    public function setMessage($message);

    public function setSummary($summary);
    public function getSummary();

    public function getAuthorName();
    public function setAuthorName($name);

    public function toArray();
}