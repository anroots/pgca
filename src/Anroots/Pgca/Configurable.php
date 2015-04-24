<?php

namespace Anroots\Pgca;

interface Configurable
{

    /**
     * @param array $options
     * @return void
     */
    public function configure(array $options = []);

    /**
     * @return bool
     */
    public function isConfigured();
}
