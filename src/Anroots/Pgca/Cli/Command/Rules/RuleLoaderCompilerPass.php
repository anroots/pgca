<?php

namespace Anroots\Pgca\Cli\Command\Rules;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RuleLoaderCompilerPass implements CompilerPassInterface
{

    /**
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {

        $rulesCommand = $container->getDefinition(
            'cli.command.rulesCommand'
        );

        $rules = $container->findTaggedServiceIds('rule');

        foreach ($rules as $id => $tags) {

            foreach ($tags as $attributes) {
                $rulesCommand->addMethodCall(
                    'addRule',
                    array(new Reference($id))
                );
            }
        }
    }
}