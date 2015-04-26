<?php

namespace Anroots\Pgca\Cli\Command\Analyze;

use Anroots\Pgca\Cli\Command\AbstractAnalyzeCommand;
use Symfony\Component\Console\Input\InputOption;

class FileSystemCommand extends AbstractAnalyzeCommand
{
    public function configure()
    {

        parent::configure();
        $this->setName('analyze:filesystem')
            ->setAliases(['analyze'])
            ->addOption(
                'provider-revision',
                'r',
                InputOption::VALUE_OPTIONAL,
                'The Git revision from which to analyze the log'
            )
            ->addOption(
                'provider-limit',
                null,
                InputOption::VALUE_OPTIONAL,
                'How many commits to include'
            )
            ->addOption(
                'provider-path',
                'p',
                InputOption::VALUE_OPTIONAL,
                'The path to the project directory'
            )
            ->setDescription('Analyses Git commit messages from the .git directory');
    }

    /**
     * {@inheritdoc}
     */
    protected function getCliOverrideNames()
    {
        return array_merge(parent::getCliOverrideNames(), ['provider-path', 'provider-limit']);
    }
}
