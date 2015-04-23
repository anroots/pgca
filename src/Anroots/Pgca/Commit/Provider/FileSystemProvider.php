<?php

namespace Anroots\Pgca\Commit\Provider;

use Gitonomy\Git\Commit;
use Gitonomy\Git\Diff\File;
use Gitonomy\Git\Repository;

class FileSystemProvider extends AbstractProvider
{
    const DEFAULT_LIMIT = 400;
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

    private $counters = [
        'analyzed' => 0,
        'skipped' => 0,
        'total' => 0
    ];

    public function setRepository(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getCommits()
    {

        /** @var \Gitonomy\Git\Log $log */
        $log = $this->repository->getLog($this->options['revision'], null, null, $this->options['limit']);

        if (!$log->countCommits()) {
            throw new \RuntimeException('No commits found');
        }

        $this->counters['total'] = $log->countCommits();

        $commits = $log->getIterator();
        foreach ($commits as $commitData) {
            /** @var \Gitonomy\Git\Commit $commitData */
            $commit = $this->createCommit($commitData);

            if ($this->skipCommit($commit)) {
                $this->counters['skipped']++;
                continue;
            }
            $this->counters['analyzed']++;
            yield $commit;
        }
    }

    public function countAnalyzed()
    {
        return $this->counters['analyzed'];
    }

    public function countSkipped()
    {
        return $this->counters['skipped'];
    }

    public function countTotal()
    {
        return $this->counters['total'];
    }

    /**
     * @param Commit $commitData
     * @return \Anroots\Pgca\Git\Commit
     */
    private function createCommit(Commit $commitData)
    {
        // Remove the last character from the commit message.
        // This is always a newline due to the way Gitlib works.
        $commitMessage = substr($commitData->getMessage(), 0, mb_strlen($commitData->getMessage()) - 1);


        $files = $this->extractFilePaths($commitData->getDiff()->getFiles());

        return $this->commitFactory->create([
            'hash' => $commitData->getHash(),
            'message' => $commitMessage,
            'shortHash' => $commitData->getShortHash(),
            'summary' => $commitData->getSubjectMessage(),
            'authorName' => $commitData->getAuthorName(),
            'changedFiles' => $files
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

    /**
     * @param File[] $files
     * @return array
     */
    private function extractFilePaths(array $files)
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $file->getName();
        }

        return $paths;
    }
}
