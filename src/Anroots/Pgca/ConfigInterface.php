<?php

namespace Anroots\Pgca;

interface ConfigInterface
{
    public function get($path);

    public function setPaths(array $paths);

    public function getPaths();

    public function load();
}
