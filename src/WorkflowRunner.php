<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow;

use JustSteveKing\Workflow\Exceptions\WorkflowException;
use JustSteveKing\Workflow\ValueObjects\Workflow;
use ReflectionClass;
use Throwable;

final class WorkflowRunner
{
    /**
     * @param array<int,Workflow> $workflows
     */
    protected function __construct(
        protected array $workflows,
        protected array $logs = [],
    ) {}

    /**
     * @param array<int,Workflow> $workflows
     * @return static
     */
    public static function build(array $workflows = []): WorkflowRunner
    {
        return new WorkflowRunner(
            workflows: $workflows
        );
    }

    public function run(): void
    {
        foreach ($this->workflows as $workflow) {
            $workflow->jobs->map(function ($job) {

                if (! class_exists(class: $job->target)) {
                    throw new WorkflowException(
                        message: "Workflow target [$job->target] does not exist"
                    );
                }

                if (! method_exists(object_or_class: $job->target, method: $job->method)) {
                    throw new WorkflowException(
                        message: "[$job->method] does not exist on target [$job->target]",
                    );
                }

                $class = new ReflectionClass(
                    objectOrClass: $job->target,
                );

                try {
                    $target = $class->newInstance();
                } catch (Throwable $exception) {
                    throw new WorkflowException(
                        message: "Cannot construct [$job->target]",
                        previous: $exception,
                    );
                }

                $this->logs[$job->name] = $target->{$job->method}(...$job->args);
            });
        }
    }

    public function logs(): array
    {
        return $this->logs;
    }
}
