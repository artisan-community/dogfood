<?php

use ArtisanBuild\GH\GH;
use Illuminate\Support\Facades\Process;

beforeEach(fn() => Process::fake());

describe('The search command', function () {

    it('calls the repos command correctly', function () {
        GH::search()->repos('laravel');
        Process::assertRan("gh search repos --query 'laravel'");
    });

    it('calls the issues command correctly', function () {
        GH::search()->issues('bug label:bug');
        Process::assertRan("gh search issues --query 'bug label:bug'");
    });

    it('calls the prs command correctly', function () {
        GH::search()->prs('fix label:bug');
        Process::assertRan("gh search prs --query 'fix label:bug'");
    });

    it('calls the commits command correctly', function () {
        GH::search()->commits('fix: typo');
        Process::assertRan("gh search commits --query 'fix: typo'");
    });

    it('calls the code command correctly', function () {
        GH::search()->code('function findUser');
        Process::assertRan("gh search code --query 'function findUser'");
    });

    it('calls the users command correctly', function () {
        GH::search()->users('octocat');
        Process::assertRan("gh search users --query 'octocat'");
    });
});
