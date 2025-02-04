<?php

declare(strict_types=1);

namespace ArtisanBuild\Adverbs\Traits;

use ReflectionClass;
use Throwable;
use Thunk\Verbs\State;

trait HasVerbsState
{
    /**
     * @throws Throwable
     */
    public function verbs_state(): State
    {
        $reflection = new ReflectionClass($this);
        throw_if(! $reflection->hasProperty('stateClass'), 'Please provide a protected string property called stateClass on your model to use the HasVerbsState trait on the class.');

        $state = $this->stateClass;

        return $state::loadOrFail($this->id);
    }
}
