<?php

namespace Anroots\Pgca\Report\Printer;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * {@inheritdoc}
 */
class ConsolePrinter extends AbstractPrinter
{

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param OutputInterface $output
     * @return $this
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function write($content)
    {
        $this->output->write($content);
    }
}
