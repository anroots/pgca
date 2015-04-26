<?php

namespace Anroots\Pgca;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * {@inheritdoc}
 */
abstract class AbstractSetConfigurator implements SetConfiguratorInterface
{

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $configPath;

    /**
     * @param ContainerInterface $container
     * @param ConfigInterface $config
     */
    public function __construct(ContainerInterface $container, ConfigInterface $config)
    {

        $this->config = $config;
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(CollectionSetAwareInterface $subject)
    {

        $services = $this->config->get($this->configPath);

        if (!count($services)) {
            return;
        }

        $serviceInstances = [];
        foreach ($services as $serviceData) {
            $service = $this->createService($serviceData['name']);

            if (array_key_exists('config', $serviceData)) {
                $service->configure($serviceData['config']);
            }
            $serviceInstances[] = $service;

        }

        $subject->setCollection($serviceInstances);
    }

    /**
     * @param string $serviceName
     * @return object
     */
    private function createService($serviceName)
    {
        if (!$this->container->has($this->getServiceName($serviceName))) {
            throw new ServiceNotFoundException($this->getServiceName($serviceName));
        }

        $service = $this->container->get($this->prefix . $serviceName);

        return $service;
    }

    /**
     * {@inheritdoc}
     */
    protected function getServiceName($suffix)
    {
        return $this->prefix . $suffix;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }
}
