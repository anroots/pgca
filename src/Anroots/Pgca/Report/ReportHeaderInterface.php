<?php

namespace Anroots\Pgca\Report;

use Anroots\Pgca\Report\Report\ReportColumn;

interface ReportHeaderInterface
{

    /**
     * @param ReportColumn[] $columns
     */
    public function addRow(array $columns);

    /**
     * @return \DateTime
     */
    public function getCreated();

    /**
     * @return ReportColumn[]
     */
    public function getRows();
}
