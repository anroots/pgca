<?php

namespace Anroots\Pgca\Report\Printer;

interface PrinterInterface
{
    /**
     * @param string $content
     * @return void
     */
    public function write($content);
}
