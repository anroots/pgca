<?php

namespace Anroots\Pgca\Commit\Provider;

use Anroots\Pgca\Git\Commit\FactoryInterface;

abstract class AbstractProvider implements CommitProviderInterface
{

    /**
     * @var FactoryInterface
     */
    protected $commitFactory;

    /**
     * @param FactoryInterface $commitFactory
     */
    public function __construct(FactoryInterface $commitFactory)
    {
        $this->commitFactory = $commitFactory;
    }
}