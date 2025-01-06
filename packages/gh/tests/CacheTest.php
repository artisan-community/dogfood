<?php

use ArtisanBuild\GH\GH;
use Illuminate\Support\Facades\Process;

beforeEach(fn() => Process::fake());

describe('The cache command', function () {

    it('calls the list command correctly', function () {
        GH::cache()->list();
        Process::assertRan('gh cache list');
    });

    it('calls the delete command correctly without a key', function () {
        GH::cache()->delete();
        Process::assertRan('gh cache delete');
    });

    it('calls the delete command correctly with a key', function () {
        GH::cache()->delete('cache-key-123');
        Process::assertRan('gh cache delete cache-key-123');
    });

    it('calls the restore command correctly', function () {
        GH::cache()->restore('cache-key-123');
        Process::assertRan('gh cache restore cache-key-123');
    });
});
