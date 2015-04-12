<?php

namespace Anroots\Pgca\Test\Rule\Content;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Test\Rule\AbstractRuleTest;

abstract class AbstractContentTest extends AbstractRuleTest
{


    abstract public function provideInvalidContent();

    abstract public function provideValidContent();

    /**
     * @dataProvider provideInvalidContent
     * @param array $content
     * @covers ::run
     */
    public function testRuleFailsForInvalidContent(array $content)
    {

        $this->expectFailure();

        $commit = $this->commitFactory($content);
        $this->rule->apply($commit);
    }


    /**
     * @covers ::run
     * @dataProvider provideValidContent
     * @param array $content
     */
    public function testRulePassesForValidContent(array $content)
    {
        $this->expectSuccess();

        $commit = $this->commitFactory($content);
        $this->rule->apply($commit);
    }

    /**
     * @param array $content
     * @return Commit
     */
    protected function commitFactory(array $content)
    {
        $commit = new Commit;
        $commit->setChangedFiles($content);

        return $commit;
    }

}
