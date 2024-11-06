<?php

declare(strict_types=1);

namespace ArtisanBuild\VerbsFlux\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;

class AnonymousComponentController
{
    public function __invoke(): Application|\Illuminate\Contracts\View\View|Factory|View|null
    {
        return view('verbs-flux::anonymous');
    }
}
