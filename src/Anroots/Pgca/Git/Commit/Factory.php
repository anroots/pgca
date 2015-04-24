<?php

namespace Anroots\Pgca\Git\Commit;

use Anroots\Pgca\Git\Commit;

/**
 * {@inheritdoc}
 */
class Factory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $defaults = [
            'hash' => null,
            'message' => null,
            'summary' => null,
            'shortHash' => null,
            'changedFiles' => [],
            'authorName' => null
        ];

        $data = array_replace($defaults, $data);

        $commit = new Commit;
        $commit->setHash($data['hash'])
            ->setMessage($data['message'])
            ->setSummary($data['summary'])
            ->setShortHash($data['shortHash'])
            ->setChangedFiles($data['changedFiles'])
            ->setAuthorName($data['authorName']);

        return $commit;
    }
}
