<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\AbstractSetConfigurator;
use Anroots\Pgca\ConfigInterface;
use Anroots\Pgca\Rule\RuleInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RuleSetConfigurator extends AbstractSetConfigurator
{
protected $configPath = 'analyzers.message.rules';
    protected $prefix = 'rule.';
}