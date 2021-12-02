<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\Loaders;

use InvalidArgumentException;
use JustSteveKing\Workflow\Contracts\LoaderContract;
use Symfony\Component\Yaml\Yaml;
use Throwable;

class YamlLoader implements LoaderContract
{
    /**
     * @param string $path
     * @return array
     */
    public static function load(string $path): array
    {
        try {
            $contents = Yaml::parseFile(
                filename: $path,
            );
        } catch (Throwable $exception) {
            throw new InvalidArgumentException(
                message: "[$path] cannot be accessed or found",
                previous: $exception,
            );
        }

        return (array) $contents;
    }
}
