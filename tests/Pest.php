<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

pest()->extends(TestCase::class, DatabaseTransactions::class)->in('Feature', '../packages/*');

expect()->extend('toBeIgnoringWhitespace', function (string $expected) {
    expect(trim(preg_replace('/\s\s+/', ' ', $this->value)))->toBe(trim(preg_replace('/\s\s+/', ' ', $expected)));
});
