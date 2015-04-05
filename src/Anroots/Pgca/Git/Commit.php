<?php

namespace Anroots\Pgca\Git;

class Commit implements CommitInterface
{

    private $hash;
    private $shortHash;
    private $message;
    private $summary;
    private $authorName;

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param mixed $authorName
     * @return $this
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    public function getHash()
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortHash()
    {
        return $this->shortHash;
    }

    /**
     * @param mixed $shortHash
     * @return $this
     */
    public function setShortHash($shortHash)
    {
        $this->shortHash = $shortHash;

        return $this;
    }

}