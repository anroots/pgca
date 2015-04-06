<?php

namespace Anroots\Pgca\Git\Commit;

use Anroots\Pgca\Git\Commit;

interface FactoryInterface
{
    public function create(array $data);
}
