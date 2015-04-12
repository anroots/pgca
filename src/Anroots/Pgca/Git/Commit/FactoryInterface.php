<?php

namespace Anroots\Pgca\Git\Commit;

use Anroots\Pgca\Git\Commit;

interface FactoryInterface
{
    /**
     * @param array $data
     * @return Commit
     */
    public function create(array $data);
}
