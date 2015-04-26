<?php

namespace Anroots\Pgca\Test\Rule\Content;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Content\HasNoIgnoredFiles;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Content\HasNoIgnoredFiles
 */
class HasNoIgnoredFilesTest extends AbstractContentTest
{

    /**
     * {@inheritdoc}
     */
    public function provideInvalidContent()
    {
        return [
            [['.idea/misc.xml']],
            [['vendor/anroots/pgca/readme.md']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function provideValidContent()
    {
        return [
            [['readme.md']],
            [['readme.md', 'src/mediator.php']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRuleClass()
    {
        return HasNoIgnoredFiles::class;
    }
}
