<?php

namespace Anroots\Pgca\Commit\Analyzer;

use Anroots\Pgca\AbstractSetConfigurator;

/**
 * {@inheritdoc}
 */
class RuleSetConfigurator extends AbstractSetConfigurator
{
    protected $configPath = 'analyzer.rules';
    protected $prefix = 'rule.';
}
