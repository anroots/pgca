<?php

namespace Anroots\Pgca\Commit\Provider;

use Anroots\Pgca\AbstractSetConfigurator;

class FilterSetConfigurator extends AbstractSetConfigurator
{
    protected $configPath = 'provider.filters';

    protected $prefix = 'commit.filter.';
}
