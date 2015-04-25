<?php

namespace Anroots\Pgca\Cli\Command\Rules;

use Anroots\Pgca\Cli\ContainerAwareCommand;
use Anroots\Pgca\Rule\RuleInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

class ShowCommand extends ContainerAwareCommand
{
    use RuleSetAwareTrait;

    protected function configure()
    {
        $this->setName('rules:show')
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of the rule to show information for')
            ->addOption('all', 'a', InputOption::VALUE_NONE, 'Show information about all rules')
            ->setDescription('Show details about a particular rule');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        if ($input->hasOption('all')) {
            foreach ($this->rules as $rule) {
                $this->printRule($output, $rule);
            }

            return 0;
        }

        if (empty($input->getArgument('name'))) {
            $output->writeln('<error>You must specify the name of the rule.</error>');

            return 1;
        }

        try {
            /** @var RuleInterface $rule */
            $rule = $this->getContainer()->get('rule.' . $input->getArgument('name'));
        } catch (InvalidArgumentException $e) {
            $output->writeln(sprintf('<error>The rule "%s" does not exist.</error>', $input->getArgument('name')));

            return 1;
        }

        $this->printRule($output, $rule);

        return 0;
    }

    /**
     * @param OutputInterface $output
     * @param RuleInterface $rule
     */
    private function printRule(OutputInterface $output, RuleInterface $rule)
    {
        $table = new Table($output);

        $table->setStyle('compact')
            ->setRows([
                ['Name', $rule->getName()],
                ['Category', $rule->getCategory()],
                ['Severity', $rule->getSeverity()],
                ['Message', $rule->getMessage()],
            ]);

        $table->render();
        $output->writeln('---------------------------------------------');
    }
}
