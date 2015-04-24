<?php

namespace Anroots\Pgca;

interface ConfigInterface
{
    /**
     * @param string $path
     * @return string|array
     */
    public function get($path);

    /**
     * @param array $paths
     * @return $this
     */
    public function setPaths(array $paths);

    /**
     * @return array
     */
    public function getPaths();

    /**
     * @return void
     */
    public function load();
}
