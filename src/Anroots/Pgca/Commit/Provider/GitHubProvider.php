<?php

namespace Anroots\Pgca\Commit\Provider;

use Anroots\Pgca\CollectionSetAwareInterface;
use Anroots\Pgca\Git\Commit\FactoryInterface;
use Github\Client;

class GitHubProvider extends AbstractProvider implements CollectionSetAwareInterface
{

    private $defaultOptions = [
        'user' => null,
        'repo' => null,
        'branch' => 'master'
    ];

    private $user;
    private $repo;
    private $branch;
    /**
     * @var Client
     */
    private $client;

    /**
     * @param FactoryInterface $commitFactory
     * @param Client $client
     */
    public function __construct(FactoryInterface $commitFactory, Client $client)
    {
        parent::__construct($commitFactory);
        $this->client = $client;
    }


    /**
     * @return \Generator
     */
    public function getCommits()
    {
        $commits = $this->client->api('repo')
            ->commits()
            ->all($this->user, $this->repo, ['sha' => $this->branch]);

        if (!count($commits)) {
            return;
        }

        foreach ($commits as $commit) {
            yield $this->createCommit($commit);
        }
    }

    private function createCommit(array $commitData)
    {
        return $this->commitFactory->create([
            'hash' => $commitData['sha'],
            'message' => $commitData['commit']['message']
        ]);
    }

    public function configure(array $options)
    {
        $options = array_replace_recursive($this->defaultOptions, $options);

        $this->user = $options['user'];
        $this->repo = $options['repo'];
        $this->branch = $options['branch'];
    }
}
