<?php

namespace Anroots\Pgca\Cli\Command\Rules;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Anroots\Pgca\Rule\RuleInterface;
use Anroots\Pgca\Rule\RuleSetAwareTrait;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends ContainerAwareCommand
{
    use RuleSetAwareTrait;

    protected function configure()
    {
        $this->setName('rules:list')
            ->addArgument('category', InputArgument::OPTIONAL, 'Only list rules belonging to the specified category')
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
            if ($this->isRuleSkipped($input, $rule)) {
                continue;
            }

            $table->addRow([$rule->getName(), $rule->getCategory()]);
        }

        $table->render();
    }

    /**
     * @param InputInterface $input
     * @param RuleInterface $rule
     * @return bool
     */
    private function isRuleSkipped(InputInterface $input, RuleInterface $rule)
    {
        if ($input->getArgument('category') === null) {
            return false;
        }

        return strtolower($rule->getCategory()) !== strtolower($input->getArgument('category'));
    }
}
