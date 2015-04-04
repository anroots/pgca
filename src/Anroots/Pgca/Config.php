<?php

namespace Anroots\Pgca;

use Dflydev\DotAccessData\Data;
use Dflydev\DotAccessData\DataInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class Config implements ConfigInterface
{
    /**
     * @var string[]
     */
    private $paths = [
        '.',
        'config'
    ];

    /**
     * @var DataInterface
     */
    private $config;

    public function load()
    {
        $locator = new FileLocator($this->paths);
        $configFile = $locator->locate('pgca.yml');
        $fileContents = Yaml::parse(file_get_contents($configFile), true);
        $this->config = new Data($fileContents);
    }

    public function get($path)
    {
        if ($this->config === null) {
            throw new \RuntimeException('Config file not loaded');
        }

        return $this->config->get($path);

    }

    public function setPaths(array $paths)
    {
        $this->paths = $paths;

        return $this;
    }

    public function getPaths()
    {
        return $this->paths;
    }
}