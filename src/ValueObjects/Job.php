<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\ValueObjects;

class Job
{
    /**
     * @param string $uuid
     * @param string $name
     * @param string $target
     * @param string $method
     * @param array $args
     */
    public function __construct(
        public string $uuid,
        public string $name,
        public string $target,
        public string $method,
        public array $args,
    ) {}
}
