<?php

use ArtisanBuild\GH\GH;
use Illuminate\Support\Facades\Process;

beforeEach(fn () => Process::fake());

describe('The codespace command', function () {

    it('calls the list command correctly', function () {
        GH::codespace()->list();
        Process::assertRan('gh codespace list');
    });

    it('calls the create command correctly with no options', function () {
        GH::codespace()->create();
        Process::assertRan('gh codespace create');
    });

    it('calls the create command correctly with repository', function () {
        GH::codespace()->create('artisan-build/test');
        Process::assertRan("gh codespace create --repo 'artisan-build/test'");
    });

    it('calls the create command correctly with repository and branch', function () {
        GH::codespace()->create('artisan-build/test', 'main');
        Process::assertRan("gh codespace create --repo 'artisan-build/test' --branch 'main'");
    });

    it('calls the create command correctly with repository, branch, and machine', function () {
        GH::codespace()->create('artisan-build/test', 'main', 'standardLinux');
        Process::assertRan("gh codespace create --repo 'artisan-build/test' --branch 'main' --machine 'standardLinux'");
    });

    it('calls the delete command correctly', function () {
        GH::codespace()->delete('my-codespace');
        Process::assertRan("gh codespace delete --codespace 'my-codespace'");
    });

    it('calls the stop command correctly', function () {
        GH::codespace()->stop('my-codespace');
        Process::assertRan("gh codespace stop --codespace 'my-codespace'");
    });

    it('calls the logs command correctly', function () {
        GH::codespace()->logs('my-codespace');
        Process::assertRan("gh codespace logs --codespace 'my-codespace'");
    });

    it('calls the ports command correctly', function () {
        GH::codespace()->ports('my-codespace');
        Process::assertRan("gh codespace ports --codespace 'my-codespace'");
    });
});
