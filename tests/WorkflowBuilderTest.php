<?php

declare(strict_types=1);

use JustSteveKing\Workflow\Loaders\YamlLoader;
use JustSteveKing\Workflow\ValueObjects\Workflow;
use JustSteveKing\Workflow\WorkflowBuilder;

it('can create a workflow from an array', function () {
    expect(
        WorkflowBuilder::make(
            payload: YamlLoader::load(
                       path: __DIR__ . '/Fixtures/test.yaml',
                   ),
        )
    )->toBeInstanceOf(Workflow::class)->name->toEqual('test');
});
