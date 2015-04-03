<?php

namespace Anroots\Pgca\Commit\Provider;

class FileSystemProvider extends AbstractProvider
{

    public function getCommits()
    {
        $commits = [
            ['hash' => 'b1c23af2c7e2ed95276d4844d406b5ec74488944'],
        ];
        foreach ($commits as $commitData) {
            $commit = $this->commitFactory->create($commitData);
            yield $commit;
        }
    }
}