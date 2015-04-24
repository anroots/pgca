<?php
namespace Anroots\Pgca\Report\Composer;

use Anroots\Pgca\Report\Report\ReportColumn;
use Anroots\Pgca\Report\ReportHeaderInterface;
use Anroots\Pgca\ReportInterface;

/**
 * {@inheritdoc}
 */
abstract class AbstractComposer implements ReportComposerInterface
{
    /**
     * @var ReportInterface
     */
    private $report;

    /**
     * @var ReportHeaderInterface
     */
    private $reportHeader;

    /**
     * @param ReportHeaderInterface $reportHeader
     */
    public function __construct(ReportHeaderInterface $reportHeader)
    {

        $this->reportHeader = $reportHeader;
    }

    /**
     * {@inheritdoc}
     */
    public function getReportHeader()
    {
        return $this->reportHeader;
    }

    /**
     * {@inheritdoc}
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * {@inheritdoc}
     */
    public function setReport(ReportInterface $report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {

        if ($this->getReport()->countViolations() === 0) {
            return $this;
        }

        return $this->buildRows();
    }

    /**
     * @return mixed
     */
    abstract protected function buildRows();

    /**
     * @param string $content Column content
     * @param string $key String key for machines
     * @param string $title Human-readable title
     * @return ReportColumn
     */
    protected function column($content, $key, $title)
    {
        $column = new ReportColumn;
        $column->setContent($content)
            ->setKey($key)
            ->setTitle($title);

        return $column;
    }
}
