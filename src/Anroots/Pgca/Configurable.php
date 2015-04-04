<?php

namespace Anroots\Pgca;

interface Configurable
{


    public function configure(array $options = []);


    public function isConfigured();
}