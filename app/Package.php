<?php

namespace App;

class Package
{
    public function __construct(
        public string $name,
        public string $path,
    )
    {

    }

    public static function load(string $from): Package
    {
        return new self($from, base_path("packages/{$from}"));
    }

}
