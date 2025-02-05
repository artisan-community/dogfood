<?php

declare(strict_types=1);

namespace ArtisanBuild\FatEnums\Tests\Fixtures;

use ArtisanBuild\FatEnums\StateMachine\HasStateMachine;
use Illuminate\Database\Eloquent\Model;

class DummyModel extends Model
{
    use HasStateMachine;
    use \Sushi\Sushi;

    protected array $state_machines = [];

    protected $rows = [
        ['id' => 1111, 'name' => 'Foo'],
        ['id' => 2222, 'name' => 'Bar'],
    ];
}
