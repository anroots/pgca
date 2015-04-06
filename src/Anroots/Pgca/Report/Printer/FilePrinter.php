<?php

namespace Anroots\Pgca\Report\Printer;

class FilePrinter extends AbstractPrinter
{
    /**
     * @var string
     */
    private $fileName = '/dev/null';

    /**
     * {@inheritdoc}
     */
    public function write($content)
    {
        $bytes = file_put_contents($this->getFileName(), $content);

        if ($bytes === false) {
            throw new \RuntimeException('Could not write to the report file!');
        }
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
}
