<?php

namespace Anroots\Pgca\Report;

use Anroots\Pgca\ReportInterface;

interface ReportPrinterInterface
{
    public function compose();

    public function setReport(ReportInterface $report);
}