<?php

namespace Anroots\Pgca\Report;

use Anroots\Pgca\Report\Composer\ReportComposerInterface;
use Anroots\Pgca\Report\Printer\FilePrinter;
use Anroots\Pgca\Report\Printer\PrinterInterface;
use Anroots\Pgca\Report\Serializer\SerializerInterface;
use Anroots\Pgca\ReportInterface;

class ReportBuilder implements ReportBuilderInterface
{
    /**
     * @var ReportComposerInterface
     */
    private $composer;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var PrinterInterface
     */
    private $printer;

    /**
     * @var ReportInterface
     */
    private $report;


    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $composedReport = $this->composer->build();
        $content = $this->serializer->serialize($composedReport);
        $this->printer->write($content);
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
        $this->composer->setReport($report);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getComposer()
    {
        return $this->composer;
    }

    /**
     * {@inheritdoc}
     */
    public function setComposer(ReportComposerInterface $composer)
    {
        $this->composer = $composer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrinter(PrinterInterface $printer)
    {
        $this->printer = $printer;

        if ($printer instanceof FilePrinter) {
            $printer->setFileName($this->serializer->getFileName());
        }

        return $this;
    }
}