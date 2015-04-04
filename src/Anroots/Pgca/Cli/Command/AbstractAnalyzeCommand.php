<?php

namespace Anroots\Pgca\Cli\Command;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\ConfigInterface;
use Anroots\Pgca\Report\ReportPrinterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractAnalyzeCommand extends ContainerAwareCommand
{

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->config = $this->getContainer()->get('config');

        /** @var CommitAnalyzerInterface $analyzer */
        $analyzer = $this->getContainer()->get('commit.analyzer.analyzer');

        $provider = $this->providerFactory($this->getConfig($input));
        $analyzer->setCommitProvider($provider);

        $analyzer->run();

        /** @var ReportPrinterInterface $report */
        $report = $this->getContainer()->get('report.simpleConsoleReport');
        $report->setReport($analyzer->getReport())
            ->setOutput($output)
            ->compose();

        return $analyzer->getReport()->countViolations() === 0 ?: 1;
    }


    public function getConfig(InputInterface $input)
    {
        $providerConfig = $this->config->get('provider');
        $defaults = $this->getDefinition()->getOptionDefaults();
        $options = array_filter($input->getOptions(), function ($value, $key) use ($defaults, $providerConfig) {

            $isNotDefaultValue = $value !== $defaults[$key];

            $providerConfigDoesNotSetThis = !array_key_exists($key, $providerConfig);

            return $isNotDefaultValue || $providerConfigDoesNotSetThis;
        }, ARRAY_FILTER_USE_BOTH);

        $mergedConfig = array_replace($providerConfig, $options);

        return $mergedConfig;
    }

    /**
     * @return CommitProviderInterface
     */
    private function providerFactory(array $providerConfig)
    {
        $providerServiceName = 'commit.provider.' . $providerConfig['name'];

        /** @var CommitProviderInterface $provider */
        $provider = $this->getContainer()->get($providerServiceName);
        $provider->configure($providerConfig);


        return $provider;
    }


}