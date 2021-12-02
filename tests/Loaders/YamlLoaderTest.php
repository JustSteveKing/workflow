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

it('throws an Invalid Arguement Exception if the file path does not exist', function () {
    YamlLoader::load(
        path: __DIR__ . '/../Fixtures/testing.yaml',
    );
})->throws(InvalidArgumentException::class);
