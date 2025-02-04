<?php

declare(strict_types=1);

namespace ArtisanBuild\FatEnums\Traits;

use Illuminate\Database\Eloquent\Model;

trait DatabaseRecordsEnum
{
    public function get()
    {
        $model = $this::ModelName;

        /** @var Model $model */
        return $model::find($this->value);
    }
}
