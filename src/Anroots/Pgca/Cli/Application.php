<?php

namespace Anroots\Pgca\Cli;

use Anroots\Pgca\Cli\Command\Analyze\FileSystemCommand;
use Anroots\Pgca\Cli\Command\Rules\RuleLoaderCompilerPass;
use Anroots\Pgca\Cli\Command\RulesCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Command\HelpCommand;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class Application extends \Symfony\Component\Console\Application
{
    use ContainerAwareTrait;

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->setContainer($this->containerFactory());

        parent::__construct($name, $version);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultCommands()
    {
        return [
            new HelpCommand,
            new ListCommand,
            new FileSystemCommand,
            $this->container->get('cli.command.rulesCommand')
        ];
    }


    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return ContainerInterface
     */
    private function containerFactory()
    {
        $container = new ContainerBuilder;
        $fileLocator = new FileLocator([
            __DIR__ . '/../../../../config',
            __DIR__ . '/../../../../../../../config'
        ]);
        $loader = new XmlFileLoader($container, $fileLocator);
        $loader->load('services.xml');

        try {
            $loader->load('pgca.xml');
        } catch (\InvalidArgumentException $e) {
            // Could not load the additional rules file
            // Todo: handle this better
        }

        $container->addCompilerPass(new RuleLoaderCompilerPass);
        $container->compile();

        return $container;
    }
}
