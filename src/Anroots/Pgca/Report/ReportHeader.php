<?php

namespace Anroots\Pgca\Report;

class ReportHeader implements ReportHeaderInterface
{
    private $rows = [];

    /**
     * @var \DateTime
     */
    private $created;

    public function __construct(\DateTime $generationDate)
    {
        $this->created = $generationDate;
    }

    public function addRow(array $columns)
    {
        $this->rows[] = $columns;
    }

    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}