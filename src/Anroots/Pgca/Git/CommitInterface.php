<?php

namespace Anroots\Pgca\Git;

interface CommitInterface
{
    /**
     * @return string
     */
    public function getHash();

    /**
     * @return string
     */
    public function getShortHash();

    /**
     * @param string $hash
     * @return $this
     */
    public function setShortHash($hash);

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash($hash);

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message);

    /**
     * @param string $summary
     * @return $this
     */
    public function setSummary($summary);

    /**
     * @return string
     */
    public function getSummary();

    /**
     * @return string
     */
    public function getAuthorName();

    /**
     * @param string $name
     * @return $this
     */
    public function setAuthorName($name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * @return array
     */
    public function toArray();

    /**
     * @param array $changedFiles
     * @return $this
     */
    public function setChangedFiles(array $changedFiles);

    /**
     * @return string[]
     */
    public function getChangedFiles();
}
