<?php

namespace Anroots\Pgca\Cli\Command\Analyze;

use Anroots\Pgca\Cli\Command\AbstractAnalyzeCommand;
use Anroots\Pgca\Commit\Provider\FileSystemProvider;
use Symfony\Component\Console\Input\InputOption;

class FileSystemCommand extends AbstractAnalyzeCommand
{
    public function configure()
    {

        parent::configure();
        $this->setName('analyze:filesystem')
            ->setAliases(['analyze'])
            ->addOption(
                'from',
                'f',
                InputOption::VALUE_OPTIONAL,
                'The Git revision from which to analyze the log',
                null
            )
            ->addOption(
                'limit',
                null,
                InputOption::VALUE_OPTIONAL,
                'How many commits to include',
                FileSystemProvider::DEFAULT_LIMIT
            )
            ->addOption(
                'path',
                'p',
                InputOption::VALUE_OPTIONAL,
                'The path to the project directory',
                null
            )
            ->setDescription('Analyses Git commit messages from the .git directory');
    }

}