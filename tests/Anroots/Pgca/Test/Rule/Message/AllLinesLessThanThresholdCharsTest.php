<?php

namespace Anroots\Pgca\Test\Rule\Message;

use Anroots\Pgca\Git\Commit;
use Anroots\Pgca\Rule\Message\AllLinesLessThanThresholdChars;
use Anroots\Pgca\Test\Rule\AbstractRuleTest;
use Faker\Factory;

/**
 * @coversDefaultClass \Anroots\Pgca\Rule\Message\AllLinesLessThanThresholdChars
 */
class AllLinesLessThanThresholdCharsTest extends AbstractRuleTest
{

    /**
     * @return array
     */
    public function provideValidMessages()
    {
        $faker = Factory::create();

        return [
            [$faker->text(50), 50],
            ['hey', 3],
            [$faker->text(50), 60],
            [$faker->text(50), 80],
            ['', 3]
        ];
    }

    /**
     * @return array
     */
    public function provideInvalidMessages()
    {
        return [
            [str_pad('hey', 40), 20],
            [str_pad('you', 100), 99],
            ['What up?', 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getRuleClass()
    {
        return AllLinesLessThanThresholdChars::class;
    }

    /**
     * @param string $message
     * @dataProvider provideInvalidMessages
     * @param $maxLength
     * @covers ::run
     */
    public function testRuleFailsForInvalidMessages($message, $maxLength)
    {
        $this->rule->configure(['max' => $maxLength]);
        $this->expectFailure();

        $commit = $this->commitFactory($message);
        $this->rule->apply($commit);
    }

    /**
     * @param string $message
     * @dataProvider provideValidMessages
     * @param $maxLength
     * @covers ::run
     */
    public function testRulePassesForValidMessages($message, $maxLength)
    {
        $this->rule->configure(['max' => $maxLength]);

        $this->expectSuccess();

        $commit = $this->commitFactory($message);
        $this->rule->apply($commit);
    }


    /**
     * @param string $message
     * @return Commit
     */
    protected function commitFactory($message)
    {
        $commit = new Commit;
        $commit->setMessage($message);

        return $commit;
    }
}
