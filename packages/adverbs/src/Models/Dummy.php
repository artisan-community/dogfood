<?php

declare(strict_types=1);

namespace ArtisanBuild\Adverbs\Models;

use ArtisanBuild\Adverbs\States\DummyState;
use ArtisanBuild\Adverbs\Traits\GetsRowsFromVerbsStates;
use ArtisanBuild\Adverbs\Traits\HasVerbsState;
use Illuminate\Database\Eloquent\Model;

class Dummy extends Model
{
    use GetsRowsFromVerbsStates;
    use HasVerbsState;

    public string $stateClass = DummyState::class;
}
