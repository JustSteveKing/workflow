<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\ValueObjects;

class Workflow
{
    /**
     * @param string $name
     * @param array<int,Job> $jobs
     */
    public function __construct(
        public string $name,
        public array $jobs = [],
    ) {}
}
