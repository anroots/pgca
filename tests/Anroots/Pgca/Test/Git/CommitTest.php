<?php

namespace Anroots\Pgca\Test\Git;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Test\TestCase;

/**
 * @coversDefaultClass \Anroots\Pgca\Git\Commit
 */
class CommitTest extends TestCase
{


    public function provideSummaryAndDescriptionMessages()
    {
        return [
            ["Summary\n\nDescription", 'Summary', 'Description'],
            ['It rained', 'It rained', null],
            ["It was cold\n", 'It was cold', null],
            ["Three\n\n\nDogs\nJumped", 'Three', "Dogs\nJumped"],
            [" Estonian winters\n\n Very cold ", 'Estonian winters', 'Very cold'],
            ["The door\nwas closed", 'The door', 'was closed']
        ];
    }

    /**
     * @param $message
     * @param $expectedSummary
     * @param $expectedDescription
     * @covers ::setMessage
     * @dataProvider provideSummaryAndDescriptionMessages
     */
    public function testSetMessageSetsCorrectSummaryAndDescription($message, $expectedSummary, $expectedDescription)
    {
        $commit = new Commit;
        $commit->setMessage($message);
        $this->assertSame($expectedDescription, $commit->getDescription());
        $this->assertSame($expectedSummary, $commit->getSummary());

    }
}