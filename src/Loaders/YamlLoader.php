<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\Loaders;

use JustSteveKing\Workflow\Contracts\LoaderContract;
use Symfony\Component\Yaml\Yaml;

class YamlLoader implements LoaderContract
{
    /**
     * @param string $path
     * @return array
     */
    public static function load(string $path): array
    {
        return (array) Yaml::parseFile(
            filename: $path,
        );
    }
}
