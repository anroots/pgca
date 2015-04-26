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
        $this->addOption('report-serializer', 's', InputOption::VALUE_OPTIONAL, 'The serializer to use')
            ->addOption('report-printer', null, InputOption::VALUE_OPTIONAL, 'The printer to use')
            ->addOption(
                'tolerance',
                't',
                InputOption::VALUE_OPTIONAL,
                'Exit with an error code if the level of violations is above the set tolerance'
            )
            ->addOption('report-composer', 'c', InputOption::VALUE_OPTIONAL, 'The composer to use');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Load configuration by merging the pgca.yml config with the overrides provided during runtime
        $this->config = $this->getContainer()->get('config');
        $this->setConfigFrom($input);

        $this->output = $output;

        // Get the object that provides Git commits
        $provider = $this->providerFactory($this->config->get('provider'));

        // Construct the analyzer (main controller) object
        $analyzer = /** @var CommitAnalyzerInterface $analyzer */
        $analyzer = $this->getContainer()->get('commit.analyzer.analyzer');

        // Run the analysis
        $analyzer->setCommitProvider($provider)
            ->run();

        // Get the object that builds the report from the analysis results
        /** @var ReportBuilderInterface $reportBuilder */
        $reportBuilder = $this->getContainer()->get('report.reportBuilder');

        // Construct report output objects
        $composer = $this->reportComposerFactory($this->config->get('report.composer'));
        $serializer = $this->serializerFactory($this->config->get('report.serializer'));
        $printer = $this->printerFactory($this->config->get('report.printer'));

        // Build the report
        $reportBuilder->setComposer($composer)
            ->setSerializer($serializer)
            ->setPrinter($printer)
            ->setReport($analyzer->getReport())
            ->build();

        // Exit with an error status if the number of violations is greater than the allowed tolerance
        return $analyzer->getReport()->getScore() > $this->config->get('tolerance') ? 1 : 0;
    }


    /**
     * Get an instance of a Commit Provider object
     *
     * @param array $providerConfig
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

    /**
     * Override static (pgca.yml) config with values from CLI input
     *
     * @param InputInterface $input
     *
     * @return void
     */
    private function setConfigFrom(InputInterface $input)
    {
        foreach ($input->getOptions() as $key => $value) {
            if (!in_array($key, $this->getCliOverrideNames()) || $value === null) {
                continue;
            }

            // Convert CLI-styled option into dot notation
            $key = str_replace('-', '.', $key);

            $this->config->set($key, $value);
        }
    }

    /**
     * Return a list of CLI option names that can be merged with the main configuration file
     *
     * @return array
     */
    protected function getCliOverrideNames()
    {
        return ['report-composer', 'report-printer', 'report-serializer', 'tolerance'];
    }
}
