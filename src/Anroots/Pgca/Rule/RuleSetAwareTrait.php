<?php

namespace Anroots\Pgca\Cli\Command\Rules;

use Anroots\Pgca\Rule\RuleInterface;

trait RuleSetAwareTrait
{

    /**
     * @var RuleInterface[]
     */
    protected $rules = [];

    /**
     * @param RuleInterface $rule
     */
    public function addRule(RuleInterface $rule)
    {
        $this->rules[] = $rule;
    }
}