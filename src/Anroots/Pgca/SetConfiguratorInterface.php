<?php

namespace Anroots\Pgca;

interface SetConfiguratorInterface
{
    public function setPrefix($prefix);

    public function load(CollectionSetAwareInterface $subject);
}
