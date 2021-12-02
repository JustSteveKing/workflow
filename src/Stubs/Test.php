<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\Stubs;

class Test
{
    /**
     * @param string $message
     * @param int $number
     * @param bool $option
     * @return array
     */
    public function run(string $message, int $number, bool $option): array
    {
        return [
            'message' => $message,
            'number' => $number,
            'option' => $option,
        ];
    }

    /**
     * @param string $message
     * @return string
     */
    public function another(string $message): string
    {
        return $message;
    }
}
