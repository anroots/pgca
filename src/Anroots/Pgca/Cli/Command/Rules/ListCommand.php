<?php

namespace Anroots\Pgca\Cli\Command\Rules;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends ContainerAwareCommand
{
    use RuleSetAwareTrait;

    protected function configure()
    {
        $this->setName('rules:list')
            ->setDescription('List all available rules');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaders(['Name', 'Category']);

        foreach ($this->rules as $rule) {
            $table->addRow([$rule->getName(), $rule->getCategory()]);
        }

        $table->render();
    }
}
