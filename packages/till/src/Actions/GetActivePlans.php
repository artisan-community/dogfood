<?php

namespace ArtisanBuild\Till\Actions;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;

class GetActivePlans
{
    public function __invoke()
    {
        return collect(File::files(config('till.plan_path')))
            ->filter(function ($file) {
                return Str::endsWith($file->getFilename(), '.php');
            })
            ->map(function ($file) {
                $contents = File::get($file->getPathname());

                // Extract namespace
                $namespace = '';
                if (preg_match('/^namespace\s+(.+?);/m', $contents, $matches)) {
                    $namespace = $matches[1];
                }

                // Extract class name
                if (preg_match('/^class\s+(\w+)/m', $contents, $matches)) {
                    $class = $matches[1];
                    return $namespace ? $namespace . '\\' . $class : $class;
                }

                return null;
            })
            ->filter() // Remove null values (files without classes)
            ->map(function ($class) {
                return new $class;
            })
            ->toArray();

    }
}
