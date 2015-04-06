<?php

namespace Anroots\Pgca;

abstract class ConfigurableEntity implements Configurable
{


    public function configure(array $options = [])
    {

    }


    public function isConfigured()
    {
        return true;
    }
}
