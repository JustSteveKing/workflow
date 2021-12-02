<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\Contracts;

interface LoaderContract
{
    public static function load(string $path): array;
}
