<?php

namespace Anroots\Pgca\Git;

class Commit implements CommitInterface
{

    private $hash;
    private $shortHash;
    private $summary;
    private $description;
    private $authorName;
    private $message;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


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

        $parts = preg_split("/\n/", $message, 2);

        $this->summary = trim($parts[0]);

        if (isset($parts[1]) && mb_strlen(trim($parts[1])) > 0) {
            $this->description = trim($parts[1]);
        }

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

    public function toArray()
    {
        return [
            'shortHash' => $this->shortHash,
            'message' => $this->message,
            'hash' => $this->hash,
            'summary' => $this->summary,
            'authorName' => $this->authorName
        ];
    }

}