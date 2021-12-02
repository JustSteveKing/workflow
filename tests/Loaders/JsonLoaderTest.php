<?php

declare(strict_types=1);

use JustSteveKing\Workflow\Loaders\JsonLoader;

it('can read a yaml file and return an array', function () {
    expect(
        JsonLoader::load(
            path: __DIR__ . '/../Fixtures/test.json',
        ),
    )->toBeArray()->name->toEqual('test');
});
