<?php

namespace Anroots\Pgca\Report;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class SimpleConsoleReport extends AbstractReport
{

    /**
     * @var OutputInterface
     */
    private $output;

    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;

        return $this;
    }

    public function compose()
    {

        if ($this->report->getViolations() === null) {
            $this->output->writeln('<info>No violations.</info>');

            return;
        }

        $table = new Table($this->output);
        $table->setHeaders(['Commit', 'Message','Explanation']);

        foreach ($this->report->getViolations() as $violation) {
            $table->addRow([
                $violation->getCommit()->getShortHash(),
                $this->truncate($violation->getCommit()->getSummary(), 20),
                $violation->getRule()->getMessage()
            ]);
        }
        $table->render();
    }

    private function truncate($text, $limit = 50)
    {
        if (strlen($text) <= $limit) {
            return $text;
        }

        return trim(substr($text, 0, $limit)) . '...';
    }
}