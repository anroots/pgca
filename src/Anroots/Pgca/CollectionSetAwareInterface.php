<?php

namespace Anroots\Pgca;

interface CollectionSetAwareInterface
{

    /**
     * @param array $collection
     * @return $this
     */
    public function setCollection(array $collection);
}
