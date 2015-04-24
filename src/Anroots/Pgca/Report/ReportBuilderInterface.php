<?php
namespace Anroots\Pgca\Report;

use Anroots\Pgca\Report\Composer\ReportComposerInterface;
use Anroots\Pgca\Report\Printer\PrinterInterface;
use Anroots\Pgca\Report\Serializer\SerializerInterface;
use Anroots\Pgca\ReportInterface;

interface ReportBuilderInterface
{
    /**
     * @return void
     */
    public function build();

    /**
     * @return ReportComposerInterface
     */
    public function getComposer();

    /**
     * @param ReportComposerInterface $composer
     * @return $this
     */
    public function setComposer(ReportComposerInterface $composer);

    /**
     * @return SerializerInterface
     */
    public function getSerializer();

    /**
     * @param SerializerInterface $serializer
     * @return $this
     */
    public function setSerializer(SerializerInterface $serializer);

    /**
     * @return PrinterInterface
     */
    public function getPrinter();

    /**
     * @param PrinterInterface $printer
     * @return $this
     */
    public function setPrinter(PrinterInterface $printer);

    /**
     * @param ReportInterface $report
     * @return mixed
     */
    public function setReport(ReportInterface $report);

    /**
     * @return ReportInterface
     */
    public function getReport();
}
