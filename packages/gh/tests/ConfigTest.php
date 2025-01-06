<?php

use ArtisanBuild\GH\GH;
use Illuminate\Support\Facades\Process;

beforeEach(fn() => Process::fake());

describe('The config command', function () {

    it('calls the get command correctly', function () {
        GH::config()->get('editor');
        Process::assertRan("gh config get 'editor'");
    });

    it('calls the set command correctly', function () {
        GH::config()->set('editor', 'vim');
        Process::assertRan("gh config set 'editor' 'vim'");
    });

    it('calls the delete command correctly', function () {
        GH::config()->delete('editor');
        Process::assertRan("gh config delete 'editor'");
    });

    it('calls the list command correctly', function () {
        GH::config()->list();
        Process::assertRan('gh config list');
    });
});
