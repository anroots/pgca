<?php

namespace Anroots\Pgca;

interface CollectionFactoryInterface
{
    public function setPrefix($prefix);
    public function create(array $services);
}