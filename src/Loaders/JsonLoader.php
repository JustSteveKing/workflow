<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\Loaders;

use InvalidArgumentException;
use JustSteveKing\Workflow\Contracts\LoaderContract;
use Throwable;

class JsonLoader implements LoaderContract
{
    /**
     * @param string $path
     * @return array
     */
    public static function load(string $path): array
    {
        try {
            $file = file_get_contents(
                filename: $path,
            );
        } catch (Throwable $exception) {
            throw new InvalidArgumentException(
                message: "[$path] cannot be accessed or found",
                previous: $exception,
            );
        }

        return (array) json_decode(
            json: strval($file),
            associative: true,
        );
    }
}
