<?php

namespace Anroots\Pgca\Commit\Provider;

use Gitonomy\Git\Commit;
use Gitonomy\Git\Repository;

class FileSystemProvider extends AbstractProvider
{

    /**
     * @var Repository
     */
    private $repository;

    private $defaultOptions = [
        'path'=> '.'
    ];

    public function setRepository(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getCommits()
    {

        $log = $this->repository->getLog();

        foreach ($log->getCommits() as $commitData) {

            $commit = $this->createCommit($commitData);

            if ($this->skipCommit($commit)) {
                continue;
            }

            yield $commit;
        }
    }

    private function createCommit(Commit $commitData)
    {
        return $this->commitFactory->create([
            'hash' => $commitData->getHash(),
            'message' => $commitData->getMessage()
        ]);
    }

    public function configure(array $options)
    {
        $options = array_replace_recursive($this->defaultOptions,$options);

        $this->setRepositoryPath($options['path']);
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