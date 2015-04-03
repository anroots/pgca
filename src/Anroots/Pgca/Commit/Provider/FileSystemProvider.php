<?php

namespace Anroots\Pgca\Commit\Provider;

class FileSystemProvider extends AbstractProvider
{

    public function getCommits()
    {
        $commits = [
            [
                'hash' => 'b1c23af2c7e2ed95276d4844d406b5ec74488944',
                'message' => 'Merge pull request #1009 from mikey/das'
            ],
            [
                'hash' => 'b1c23ff2c7e2ed95276d4844d406b5ec74488944',
                'message' => 'Load some files'
            ],
        ];

        foreach ($commits as $commitData) {
            $commit = $this->commitFactory->create($commitData);

            if ($this->skipCommit($commit)) {
                continue;
            }

            yield $commit;
        }
    }
}