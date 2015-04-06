<?php

namespace Anroots\Pgca\Cli;

use Symfony\Component\Console\Command\Command;

abstract class ContainerAwareCommand extends Command
{
    public function getContainer()
    {
        return $this->getApplication()->getContainer();
    }

    /**
     * {@inheritdoc}
     *
     * @return Application An Application instance
     */
    public function getApplication()
    {
        return parent::getApplication();
    }
}
