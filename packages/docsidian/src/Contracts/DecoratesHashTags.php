<?php

declare(strict_types=1);

namespace ArtisanBuild\Docsidian\Contracts;

use ArtisanBuild\Docsidian\DocsidianPage;
use Closure;

interface DecoratesHashTags
{
    public function __invoke(DocsidianPage $page, Closure $next): DocsidianPage;

}
