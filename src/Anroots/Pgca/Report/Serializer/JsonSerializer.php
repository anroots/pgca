<?php

namespace Anroots\Pgca\Report\Serializer;

use Anroots\Pgca\Report\Composer\ReportComposerInterface;

class JsonSerializer extends AbstractSerializer
{

    /**
     * {@inheritdoc}
     */
    public function serialize(ReportComposerInterface $report)
    {

        $output = $this->getFormattedRows($report);

        return json_encode($output, JSON_PRETTY_PRINT);
    }

    /**
     * {@inheritdoc}
     */
    public function getFileName()
    {
        return 'report.json';
    }
}
