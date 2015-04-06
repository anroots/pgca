<?php

namespace Anroots\Pgca\Report\Serializer;

use Anroots\Pgca\Report\Composer\ReportComposerInterface;

interface SerializerInterface
{
    /**
     * @param ReportComposerInterface $report
     * @return string
     */
    public function serialize(ReportComposerInterface $report);
}
