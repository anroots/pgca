<?php

namespace Anroots\Pgca\Report;

interface ReportHeaderInterface
{

    public function addRow(array $columns);

    /**
     * @return \DateTime
     */
    public function getCreated();

    public function getRows();
}