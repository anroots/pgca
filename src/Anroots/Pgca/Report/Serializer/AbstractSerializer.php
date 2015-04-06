<?php

namespace Anroots\Pgca\Report\Serializer;

use Anroots\Pgca\Report\Composer\ReportComposerInterface;

abstract class AbstractSerializer implements SerializerInterface
{


    /**
     * @param ReportComposerInterface $report
     * @return array
     */
    protected function getFormattedRows(ReportComposerInterface $report)
    {
        $rows = $report->getReportHeader()->getRows();

        $output = [];

        if (count($rows)) {
            foreach ($rows as $rowId => $row) {
                $output[$rowId] = [];
                foreach ($row as $column) {
                    $output[$rowId][$column->getKey()] = $column->getContent();
                }
            }
        }

        return [
            'violations' => $output,
            'created' => $report->getReportHeader()->getCreated()->format('Y-m-d H:i:s')
        ];
    }
}
