<?php

namespace Anroots\Pgca;

interface SetConfigurator
{
    public function setPrefix($prefix);

    public function load(CollectionSetAwareInterface $subject);
}