<?php

declare(strict_types=1);

namespace ArtisanBuild\FatEnums\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;

class DummyModel extends Model
{
    use \Sushi\Sushi;

    protected $rows = [
        ['id' => 1111, 'name' => 'Foo'],
        ['id' => 2222, 'name' => 'Bar'],
    ];
}
