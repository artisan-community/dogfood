<?php

declare(strict_types=1);

namespace ArtisanBuild\VerbsFlux\States;

use Carbon\Carbon;
use Thunk\Verbs\State;

class MeetingState extends State
{
    public string $title;
    public string $description;
    public Carbon $start;
    public int $duration;
    public ?string $location = null;
    public ?string $url = null;
}
