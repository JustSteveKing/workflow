<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\ValueObjects;

use Tightenco\Collect\Support\Collection;

class Workflow
{
    /**
     * @param string $name
     * @param Collection $jobs
     */
    public function __construct(
        public string $name,
        public Collection $jobs,
    ) {}
}
