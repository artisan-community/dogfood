<?php

declare(strict_types=1);

namespace ArtisanBuild\VerbsFlux\Models;

use ArtisanBuild\Adverbs\Traits\HasVerbsState;
use ArtisanBuild\VerbsFlux\States\MeetingState;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasVerbsState;

    protected $stateClass = MeetingState::class;

    public function casts(): array
    {
        return [
            'start' => 'datetime:Y-m-d\TH:i',
        ];
    }
}
