<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow;

use JustSteveKing\Workflow\ValueObjects\Job;
use JustSteveKing\Workflow\ValueObjects\Workflow;
use Ramsey\Uuid\Uuid;
use Tightenco\Collect\Support\Collection;

class WorkflowBuilder
{
    /**
     * @param array $payload
     * @return Workflow
     */
    public static function make(array $payload): Workflow
    {
        $workflow = new Workflow(
            name: $payload['name'],
            jobs: new Collection(),
        );

        foreach ($payload['jobs'] as $name => $job) {
            $workflow->jobs->add(
                item: new Job(
                    uuid: Uuid::uuid4()->toString(),
                    name: $name,
                    target: $job['run']['target'],
                    method: $job['run']['method'],
                    args: $job['run']['args'],
                )
            );
        }

        // turn array into workflow
        return $workflow;
    }
}
