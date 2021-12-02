<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow;

use JustSteveKing\Workflow\Contracts\WorkflowContract;

final class WorkflowRunner
{
    protected function __construct(
        protected array $workflows,
    ) {}

    /**
     * @param array<int,WorkflowContract> $workflows
     * @return static
     */
    public static function build(array $workflows = []): WorkflowRunner
    {
        return new WorkflowRunner(
            workflows: $workflows
        );
    }
}
