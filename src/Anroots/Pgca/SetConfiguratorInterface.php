<?php

namespace Anroots\Pgca;

interface SetConfiguratorInterface
{
    /**
     * @param string $prefix
     * @return string
     */
    public function setPrefix($prefix);

    /**
     * @return string
     */
    public function getPrefix();

    /**
     * {@inheritdoc}
     */
    public function load(CollectionSetAwareInterface $subject);
}
