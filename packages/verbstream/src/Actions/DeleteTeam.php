<?php

namespace ArtisanBuild\Verbstream\Actions;

use App\Models\Team;
use ArtisanBuild\Verbstream\Contracts\DeletesTeams;

class DeleteTeam implements DeletesTeams
{
    /**
     * Delete the given team.
     */
    public function delete(Team $team): void
    {
        $team->purge();
    }
}
