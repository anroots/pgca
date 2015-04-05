<?php

namespace Anroots\Pgca\Git\Commit;

use Anroots\Pgca\Git\Commit;

class Factory implements FactoryInterface
{
    public function create(array $data)
    {
        $commit = new Commit;
        $commit->setHash($data['hash'])
            ->setMessage($data['message'])
            ->setSummary($data['summary'])
        ->setShortHash($data['shortHash'])
        ->setAuthorName($data['authorName']);

        return $commit;
    }
}