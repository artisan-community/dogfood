#!/usr/bin/env bash

set -e
set -x

CURRENT_BRANCH="main"

function split()
{
    SHA1=`./bin/splitsh-lite --prefix=$1`
    git push $2 "$SHA1:refs/heads/$CURRENT_BRANCH" -f
}

function remote()
{
    git remote add $1 $2 || true
}

# git pull origin $CURRENT_BRANCH

remote bench https://github.com/artisan-build/bench.git
remote docsidian https://github.com/artisan-build/docsidian.git
remote gh https://github.com/artisan-build/gh.git
remote verbs-flux https://github.com/artisan-build/verbs-flux.git

split 'packages/bench' bench
split 'packages/docsidian' docsidian
split 'packages/gh' gh
split 'packages/verbs-flux' verbs-flux
