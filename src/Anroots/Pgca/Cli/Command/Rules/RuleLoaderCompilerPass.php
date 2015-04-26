<?php

namespace Anroots\Pgca\Cli\Command\Rules;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Load all Rules into RuleSetAware classes
 */
class RuleLoaderCompilerPass implements CompilerPassInterface
{

    /**
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        // Get all services who are tagged ruleSetAware
        $ruleSetAwareServices = $container->findTaggedServiceIds('ruleSetAware');

        foreach (array_keys($ruleSetAwareServices) as $serviceId) {
            $service = $container->getDefinition($serviceId);

            // Get all rules
            $rules = $container->findTaggedServiceIds('rule');

            // Add rules to the service
            foreach (array_keys($rules) as $id) {
                $service->addMethodCall(
                    'addRule',
                    [new Reference($id)]
                );
            }
        }
    }
}
