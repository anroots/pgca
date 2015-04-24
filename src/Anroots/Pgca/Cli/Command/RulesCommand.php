<?php

namespace Anroots\Pgca\Cli\Command;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Anroots\Pgca\Rule\RuleInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RulesCommand extends ContainerAwareCommand
{
    /**
     * @var RuleInterface[]
     */
    private $rules = [];

    protected function configure()
    {
        $this->setName('rules')
            ->setDescription('List all available rules');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaders(['Name', 'Category']);

        foreach ($this->rules as $rule) {
            $table->addRow([$rule->getName(), $rule->getCategory()]);
        }

        $table->render();
    }

    public function addRule(RuleInterface $rule)
    {
        $this->rules[] = $rule;
    }
}
