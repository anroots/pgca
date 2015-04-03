<?php

namespace Anroots\Pgca\Cli\Command;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\Rule\ViolationInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyzeCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName('analyze')
            ->addOption('provider', 'p', InputOption::VALUE_OPTIONAL, 'Git commit message provider to use', 'fs')
            ->setDescription('Analyses Git commit messages');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var CommitAnalyzerInterface $analyzer */
        $analyzer = $this->getContainer()->get('commit.analyzer.messageAnalyzer');

        /** @var CommitProviderInterface $fileSystemProvider */
        $fileSystemProvider = $this->getContainer()->get('commit.provider.fileSystemProvider');
        $mergeFilter = $this->getContainer()->get('commit.filter.mergeFilter');
        $fileSystemProvider->setFilters([$mergeFilter]);

        $analyzer->setCommitProvider($fileSystemProvider);
        $analyzer->run();

        $violations = $analyzer->getReport()->getViolations();
        $this->printViolations($output, $violations);

        return 0;
    }

    /**
     * @param OutputInterface $output
     * @param ViolationInterface[] $violations
     */
    private function printViolations(OutputInterface $output, array $violations = null)
    {

        if ($violations === null) {
            $output->writeln('<info>No violations</info>');

            return;
        }
        $table = new Table($output);
        $table->setHeaders(['Commit', 'Rule', 'Message']);

        foreach ($violations as $violation) {
            $table->addRow([
                $violation->getCommit()->getHash(),
                $violation->getRule()->getName(),
                $violation->getCommit()->getMessage()
            ]);
        }
        $table->render();
    }


}