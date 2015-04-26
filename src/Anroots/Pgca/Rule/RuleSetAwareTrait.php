<?php

namespace Anroots\Pgca\Rule;

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
