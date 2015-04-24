<?php

namespace Anroots\Pgca\Report;

use Anroots\Pgca\Report\Report\ReportColumn;

/**
 * {@inheritdoc}
 */
class ReportHeader implements ReportHeaderInterface
{
    /**
     * @var ReportColumn[]
     */
    private $rows = [];

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @param \DateTime $generationDate
     */
    public function __construct(\DateTime $generationDate)
    {
        $this->created = $generationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function addRow(array $columns)
    {
        $this->rows[] = $columns;
    }

    /**
     * {@inheritdoc}
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreated()
    {
        return $this->created;
    }
}
