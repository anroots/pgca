<?php

namespace Anroots\Pgca\Report\Composer;

use Anroots\Pgca\Report\ReportHeaderInterface;
use Anroots\Pgca\ReportInterface;

interface ReportComposerInterface
{
    /**
     * @return $this
     */
    public function build();

    /**
     * @return ReportHeaderInterface
     */
    public function getReportHeader();

    /**
     * @param ReportInterface $report
     * @return $this
     */
    public function setReport(ReportInterface $report);

    /**
     * @return ReportInterface
     */
    public function getReport();


}