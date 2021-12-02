<?php

declare(strict_types=1);

namespace JustSteveKing\Workflow\Stubs;

class FailingTest
{
    /**
     * @return void
     */
    protected function __construct() {}

    /**
     * @return FailingTest
     */
    public static function make(): FailingTest
    {
        return new FailingTest();
    }

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
}