<?php

namespace Anroots\Pgca\Report\Serializer;

use Anroots\Pgca\Report\Composer\ReportComposerInterface;

class HtmlSerializer extends AbstractSerializer
{

    /**
     * @var \Mustache_Engine
     */
    private $engine;

    /**
     * @param \Mustache_Engine $engine
     */
    public function __construct(\Mustache_Engine $engine)
    {

        $this->engine = $engine;
    }

    /**
     * @param ReportComposerInterface $report
     * @return string
     */
    public function serialize(ReportComposerInterface $report)
    {
        $rows = $this->getRows($report->getReportHeader()->getRows());

        $html = $this->engine->loadTemplate(
            file_get_contents(__DIR__ . '/../../../../../assets/templates/report.mustache')
        )
            ->render(['rows' => $rows]);

        return $html;
    }

    private function getRows(array $rows)
    {
        $out = [];
        foreach ($rows as $columns) {

            $out[]['columns'] = $columns;
        }

        return $out;
    }
}