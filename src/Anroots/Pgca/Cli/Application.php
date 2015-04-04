<?php

namespace Anroots\Pgca\Cli;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class Application extends \Symfony\Component\Console\Application
{
    use ContainerAwareTrait;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->setContainer($this->containerFactory());

        return parent::run($input, $output);
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
        $container->compile();

        return $container;
    }


}