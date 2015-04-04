<?php

namespace Anroots\Pgca;

use Anroots\Pgca\Git\CommitInterface;

interface Configurable {


    public function configure(array $options);


    public function isConfigured();
}