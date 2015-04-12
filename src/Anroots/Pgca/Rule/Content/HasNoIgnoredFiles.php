<?php

namespace Anroots\Pgca\Rule\Content;

use Anroots\Pgca\Git\CommitInterface;
use Anroots\Pgca\Rule\AbstractRule;

class HasNoIgnoredFiles extends AbstractRule
{

    private $ignoredPatterns = [
        'vendor/',
        '.idea/'
    ];

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'content.hasNoIgnoredFiles';
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return 'Commit contains files which should be in .gitignore';
    }

    /**
     * {@inheritdoc}
     */
    protected function run(CommitInterface $commit)
    {
        foreach ($commit->getChangedFiles() as $file) {
            if ($this->isFileInIgnoreList($file)) {
                $this->addViolation($commit);
                return;
            }
        }
    }

    /**
     * @param string $file
     * @return bool
     */
    private function isFileInIgnoreList($file)
    {
        foreach ($this->ignoredPatterns as $pattern) {
            if (strrpos($file, $pattern, -strlen($file)) !== false) {
                return true;
            }
        }

        return false;
    }
}