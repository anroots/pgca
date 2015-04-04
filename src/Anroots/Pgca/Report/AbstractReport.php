<?php
namespace Anroots\Pgca\Report;

use Anroots\Pgca\ReportInterface;

abstract class AbstractReport implements ReportPrinterInterface
{
    /**
     * @var ReportInterface
     */
    protected $report;

    /**
     * @return ReportInterface
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param ReportInterface $report
     * @return $this
     */
    public function setReport(ReportInterface $report)
    {
        $this->report = $report;

        return $this;
    }

}