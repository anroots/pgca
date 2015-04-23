<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\AbstractSetConfigurator;

class RuleSetConfigurator extends AbstractSetConfigurator
{
    protected $configPath = 'analyzer.rules';
    protected $prefix = 'rule.';
}
