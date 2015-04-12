<?php

namespace Anroots\Pgca\Cli\Command;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Anroots\Pgca\Commit\Analyzer\CommitAnalyzerInterface;
use Anroots\Pgca\Commit\Provider\CommitProviderInterface;
use Anroots\Pgca\ConfigInterface;
use Anroots\Pgca\Report\Composer\ReportComposerInterface;
use Anroots\Pgca\Report\Printer\ConsolePrinter;
use Anroots\Pgca\Report\Printer\PrinterInterface;
use Anroots\Pgca\Report\ReportBuilderInterface;
use Anroots\Pgca\Report\Serializer\SerializerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractAnalyzeCommand extends ContainerAwareCommand
{

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var OutputInterface
     */
    private $output;

    public function configure()
    {
        $this->addOption('serializer', 's', InputOption::VALUE_OPTIONAL, 'Specify the serializer to use', 'console')
            ->addOption('printer', null, InputOption::VALUE_OPTIONAL, 'Specify the printer to use', 'console')
            ->addOption('composer', 'c', InputOption::VALUE_OPTIONAL, 'Specify the composer to use', 'simple');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->config = $this->getContainer()->get('config');
        $this->output = $output;

        $mergedConfig = $this->getConfig($input);

        $analyzer = $this->analyzerFactory($mergedConfig);
        $analyzer->run();

        /** @var ReportBuilderInterface $reportBuilder */
        $reportBuilder = $this->getContainer()->get('report.reportBuilder');

        $reportComposer = $this->reportComposerFactory($mergedConfig['composer']);
        $serializer = $this->serializerFactory($mergedConfig['serializer']);
        $printer = $this->printerFactory($mergedConfig['printer']);

        $reportBuilder->setComposer($reportComposer)
            ->setSerializer($serializer)
            ->setPrinter($printer)
            ->setReport($analyzer->getReport())
            ->build();

        return $analyzer->getReport()->countViolations() === 0 ?: 1;
    }


    /**
     * @param InputInterface $input
     * @return array
     */
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

    /**
     * @param array $mergedConfig
     * @return CommitAnalyzerInterface
     */
    protected function analyzerFactory(array $mergedConfig)
    {
        /** @var CommitAnalyzerInterface $analyzer */
        $analyzer = $this->getContainer()->get('commit.analyzer.analyzer');

        $provider = $this->providerFactory($mergedConfig);
        $analyzer->setCommitProvider($provider);

        return $analyzer;
    }

    /**
     * @param string $name
     * @return ReportComposerInterface
     */
    private function reportComposerFactory($name)
    {
        return $this->getContainer()->get('report.composer.' . $name . 'Report');
    }

    /**
     * @param $serializer
     * @return SerializerInterface
     */
    private function serializerFactory($serializer)
    {
        return $this->getContainer()->get('report.serializer.' . $serializer . 'Serializer');
    }

    /**
     * @param string $name
     * @return PrinterInterface
     */
    private function printerFactory($name)
    {
        $printer = $this->getContainer()->get('report.printer.' . $name . 'Printer');

        // Todo: refactor with the correct design pattern. Lose the if-s
        if ($printer instanceof ConsolePrinter) {
            $printer->setOutput($this->output);
        }

        return $printer;
    }
}
