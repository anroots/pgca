<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\AbstractSetConfigurator;

class RuleSetConfigurator extends AbstractSetConfigurator
{
    protected $configPath = 'analyzers.message.rules';
    protected $prefix = 'rule.';
}
