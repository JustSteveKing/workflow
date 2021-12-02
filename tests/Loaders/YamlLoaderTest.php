<?php

declare(strict_types=1);

use JustSteveKing\Workflow\Loaders\YamlLoader;

it('can read a yaml file and return an array', function () {
    expect(
        YamlLoader::load(
            path: __DIR__ . '/../Fixtures/test.yaml',
        ),
    )->toBeArray()->name->toEqual('test');
});

