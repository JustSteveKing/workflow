<?php

declare(strict_types=1);

use JustSteveKing\Workflow\WorkflowRunner;

it('can create a new workflow runner with no workflows', function () {
    expect(
        WorkflowRunner::build(),
    )->toBeInstanceOf(WorkflowRunner::class);
});
