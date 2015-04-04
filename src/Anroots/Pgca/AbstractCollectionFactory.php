<?php

namespace Anroots\Pgca;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

abstract class AbstractCollectionFactory implements CollectionFactoryInterface
{
    protected $prefix;

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    protected function getServiceName($suffix){
        return $this->prefix.$suffix;
    }

    private function createService($serviceName)
    {
        if (!$this->container->has($this->getServiceName($serviceName))) {
            throw new ServiceNotFoundException($this->getServiceName($serviceName));
        }

        $service = $this->container->get($this->prefix . $serviceName);

        return $service;
    }


    public function create(array $services)
    {
        $serviceInstances = [];
        foreach ($services as $serviceData) {

            $service = $this->createService($serviceData['name']);

            if (array_key_exists('config', $serviceData)) {
                $service->configure($serviceData['config']);
            }
            $serviceInstances[] = $service;

        }

        return $serviceInstances;
    }

}