<?php

namespace Anroots\Pgca\Report\Serializer;

use Anroots\Pgca\Report\Composer\ReportComposerInterface;
use Anroots\Pgca\Report\ReportColumn;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * {@inheritdoc}
 */
class ConsoleSerializer extends AbstractSerializer
{

    /**
     * @var BufferedOutput
     */
    private $output;

    /**
     * @param BufferedOutput $output
     */
    public function __construct(BufferedOutput $output)
    {
        $this->output = $output;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(ReportComposerInterface $report)
    {

        $this->output->writeln($this->getHeader($report));

        $rows = $report->getReportHeader()->getRows();

        $this->printBody($rows);

        $this->output->writeln($this->getFooter($report));

        return $this->output->fetch();
    }

    /**
     * @param ReportComposerInterface $report
     * @return string
     */
    private function getHeader(ReportComposerInterface $report)
    {
        // Todo: write a pretty and more informational header
        return 'PGCA report, generated on ' . $report->getReportHeader()->getCreated()->format('Y-m-d H:i:s');
    }

    /**
     * @param ReportColumn[] $rows
     */
    private function printRows(array $rows)
    {
        $table = new Table($this->output);


        $headers = [];
        foreach ($rows[0] as $column) {
            $headers[] = $column->getTitle();
        }

        $table->setHeaders($headers);

        foreach ($rows as $row) {
            $rowContent = [];
            foreach ($row as $column) {
                $rowContent[] = $column->getContent();
            }
            $table->addRow($rowContent);
        }

        $table->render();
    }

    /**
     * @param ReportComposerInterface $report
     * @return string
     */
    private function getFooter(ReportComposerInterface $report)
    {
        return sprintf(
            "Found a total of %s commits, skipped %s and analyzed %s of them.\n"
            . "The total violations score was %s",
            $report->getReport()->getProvider()->countTotal(),
            $report->getReport()->getProvider()->countSkipped(),
            $report->getReport()->getProvider()->countAnalyzed(),
            $report->getReport()->getScore()
        );
    }

    /**
     * @param array $rows
     */
    private function printBody(array $rows)
    {
        if (!count($rows)) {
            $this->output->writeln('<info>No violations.</info>');

            return;
        }

        $this->printRows($rows);
    }
}
