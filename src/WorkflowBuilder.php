<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow;

use JustSteveKing\Workflow\ValueObjects\Job;
use JustSteveKing\Workflow\ValueObjects\Workflow;
use Ramsey\Uuid\Uuid;

class WorkflowBuilder
{
    public static function make(array $payload): Workflow
    {
        $workflow = new Workflow(
            name: $payload['name']
        );

        foreach ($payload['jobs'] as $name => $job) {
            array_push($workflow->jobs, [new Job(
                uuid: Uuid::uuid4()->toString(),
                name: $name,
                target: $job['run']['target'],
                method: $job['run']['method'],
                args: $job['run']['args'],
            )]);
        }

        // turn array into workflow
        return $workflow;
    }
}
