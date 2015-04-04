<?php

namespace Anroots\Pgca\Cli\Command;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Commit\Filter\FilterException;
use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\ConfigInterface;
use Anroots\Pgca\Rule\ViolationInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyzeCommand extends ContainerAwareCommand
{

    /**
     * @var ConfigInterface
     */
    protected $config;

    public function configure()
    {
        $this->setName('analyze')
            ->setDescription('Analyses Git commit messages');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->config = $this->getContainer()->get('config');

        /** @var CommitAnalyzerInterface $analyzer */
        $analyzer = $this->getContainer()->get('commit.analyzer.messageAnalyzer');

        $provider = $this->providerFactory();
        $analyzer->setCommitProvider($provider);

        $analyzer->run();

        $violations = $analyzer->getReport()->getViolations();
        $this->printViolations($output, $violations);

        return 0;
    }

    /**
     * @return CommitProviderInterface
     */
    private function providerFactory()
    {
        $providerConfig = $this->config->get('provider');
        $providerServiceName = 'commit.provider.' . $providerConfig['name'];

        /** @var CommitProviderInterface $provider */
        $provider = $this->getContainer()->get($providerServiceName);
        $provider->configure($providerConfig);

        $filters = [];
        foreach ($providerConfig['filters'] as $filterId) {

            $filterName = 'commit.filter.' . $filterId;
            if (!$this->getContainer()->has($filterName)) {
                throw new FilterException(sprintf('Filter %s not found!', $filterId));
            }
            $filter = $this->getContainer()->get($filterName);
            $filters[] = $filter;
        }
        $provider->setFilters($filters);

        return $provider;
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