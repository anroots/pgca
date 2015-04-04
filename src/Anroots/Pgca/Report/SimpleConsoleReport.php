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
        $table->setHeaders(['Commit', 'Rule', 'Message']);

        foreach ($this->report->getViolations() as $violation) {
            $table->addRow([
                $violation->getCommit()->getHash(),
                $violation->getRule()->getName(),
                $violation->getCommit()->getMessage()
            ]);
        }
        $table->render();
    }
}