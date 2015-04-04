<?php

namespace Anroots\Pgca\Cli\Command\Analyze;

use Anroots\Pgca\Cli\Command\AbstractAnalyzeCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

class FileSystemCommand extends AbstractAnalyzeCommand {
    public function configure()
    {
        $this->setName('analyze:filesystem')
            ->addOption(
                'from',
                null,
                InputOption::VALUE_OPTIONAL,
                'The Git revision from which to analyze the log',
                null
            )
            ->addOption(
                'limit',
                null,
                InputOption::VALUE_OPTIONAL,
                'How many commits to include',
                100
            )
            ->setDescription('Analyses Git commit messages');
    }

    public function getConfig(InputInterface $input)
    {
        $providerConfig = $this->config->get('provider');

        if ($input->hasOption('from')) {
            $providerConfig['from'] = $input->getOption('from');
        }
        if ($input->hasOption('limit')) {
            $providerConfig['limit'] = $input->getOption('limit');
        }

        return $providerConfig;
    }
}