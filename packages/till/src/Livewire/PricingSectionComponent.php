<?php

namespace ArtisanBuild\Till\Livewire;

use ArtisanBuild\Till\Actions\GetActivePlans;
use Livewire\Component;

class PricingSectionComponent extends Component
{

    public function render()
    {
        return view(config('till.pricing_section_template'))
            ->with('plans', app(GetActivePlans::class)());
    }
}
