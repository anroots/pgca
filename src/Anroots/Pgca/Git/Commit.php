<?php

namespace Anroots\Pgca\Git;

/**
 * {@inheritdoc}
 */
class Commit implements CommitInterface
{

    private $hash;
    private $shortHash;
    private $summary;
    private $description;
    private $authorName;
    private $message;

    private $changedFiles = [];

    /**
     * {@inheritdoc}
     */
    public function getChangedFiles()
    {
        return $this->changedFiles;
    }

    /**
     * {@inheritdoc}
     */
    public function setChangedFiles(array $changedFiles)
    {
        $this->changedFiles = $changedFiles;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * {@inheritdoc}
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
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
     * {@inheritdoc}
     */
    public function getShortHash()
    {
        return $this->shortHash;
    }

    /**
     * {@inheritdoc}
     */
    public function setShortHash($shortHash)
    {
        $this->shortHash = $shortHash;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
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
