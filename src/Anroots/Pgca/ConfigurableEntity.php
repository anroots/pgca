<?php

namespace Anroots\Pgca;

/**
 * {@inheritdoc}
 */
abstract class ConfigurableEntity implements Configurable
{

    /**
     * {@inheritdoc}
     */
    public function configure(array $options = [])
    {

    }

    /**
     * {@inheritdoc}
     */
    public function isConfigured()
    {
        return true;
    }
}
