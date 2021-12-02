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

it('throws an Invalid Arguement Exception if the file path does not exist', function () {
    JsonLoader::load(
        path: __DIR__ . '/../Fixtures/testing.json',
    );
})->throws(InvalidArgumentException::class);
