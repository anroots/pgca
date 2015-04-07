<?php

namespace Anroots\Pgca\Commit\Provider;

use Gitonomy\Git\Commit;
use Gitonomy\Git\Repository;

class FileSystemProvider extends AbstractProvider
{
    const DEFAULT_LIMIT = 100;
    /**
     * @var Repository
     */
    private $repository;

    private $defaultOptions = [
        'path' => '.',
        'revision' => null,
        'limit' => self::DEFAULT_LIMIT
    ];

    private $options = [];

    public function setRepository(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getCommits()
    {

        $log = $this->repository->getLog($this->options['revision'], null, null, $this->options['limit']);


        if (!$log->countCommits()) {
            throw new \RuntimeException('No commits found');
        }

        $commits = $log->getIterator();
        foreach ($commits as $commitData) {
            $commit = $this->createCommit($commitData);

            if ($this->skipCommit($commit)) {
                continue;
            }

            yield $commit;
        }
    }

    private function createCommit(Commit $commitData)
    {
        // Remove the last character from the commit message.
        // This is always a newline due to the way Gitlib works.
        $commitMessage = substr($commitData->getMessage(), 0, mb_strlen($commitData->getMessage()) - 1);

        return $this->commitFactory->create([
            'hash' => $commitData->getHash(),
            'message' => $commitMessage,
            'shortHash' => $commitData->getShortHash(),
            'summary' => $commitData->getSubjectMessage(),
            'authorName' => $commitData->getAuthorName()
        ]);
    }

    public function configure(array $options)
    {
        $this->options = array_replace_recursive($this->defaultOptions, $options);

        $this->setRepositoryPath($this->options['path']);
    }

    private function setRepositoryPath($path)
    {
        $repositoryClass = $this->getRepositoryServiceClass();
        $this->repository = new $repositoryClass($path);
    }

    private function getRepositoryServiceClass()
    {
        return Repository::class;
    }
}
