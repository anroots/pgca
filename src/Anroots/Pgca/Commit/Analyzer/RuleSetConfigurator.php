<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\ConfigInterface;
use Anroots\Pgca\Rule\RuleInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RuleSetConfigurator
{
    /**
     * @var ConfigInterface
     */
    private $config;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     * @param ConfigInterface $config
     */
    public function __construct(ContainerInterface $container, ConfigInterface $config)
    {

        $this->config = $config;
        $this->container = $container;
    }

    public function loadRules(CommitAnalyzerInterface $analyzer)
    {

        $config = $this->config->get('analyzers.' . $analyzer->getName());

        $rules = [];
        foreach ($config['rules'] as $ruleId) {
            $serviceId = 'rule.' . $ruleId;
            if (!$this->container->has($serviceId)) {
                throw new RuleException(sprintf('Rule %s not found', $ruleId));
            }
            /** @var RuleInterface $rule */
            $rule = $this->container->get($serviceId);
            $rule->setAnalyzer($analyzer);
            $rules[] = $rule;
        }
        $analyzer->setRules($rules);

    }
}