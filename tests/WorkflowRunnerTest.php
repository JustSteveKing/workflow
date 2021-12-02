<?php

declare(strict_types=1);

use JustSteveKing\Workflow\Exceptions\WorkflowException;
use JustSteveKing\Workflow\Loaders\JsonLoader;
use JustSteveKing\Workflow\Loaders\YamlLoader;
use JustSteveKing\Workflow\WorkflowBuilder;
use JustSteveKing\Workflow\WorkflowRunner;


beforeEach(function () {
    $this->runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make(
                payload: YamlLoader::load(
                    path: __DIR__ . '/Fixtures/test.yaml',
                ),
            )
        ],
    );
});

it('can create a new workflow runner with no workflows', function () {
    expect(
        WorkflowRunner::build(),
    )->toBeInstanceOf(WorkflowRunner::class);
});

it('can run a single workflow', function () {
    expect(
        $this->runner->logs()
    )->toBeArray()->toBeEmpty();

    $this->runner->run();

    expect(
        $this->runner->logs()
    )->toBeArray()->toEqual([
        'test' => [
            'message' => 'test',
            'number' => 10,
            'option' => true
        ],
        'another' => 'test',
    ]);
});

it('can run multiple workflows', function () {
    $runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make(
                payload: YamlLoader::load(
                    path: __DIR__ . '/Fixtures/test.yaml',
                ),
            ),
            WorkflowBuilder::make(
               payload: JsonLoader::load(
                  path: __DIR__ . '/Fixtures/test.json',
              ),
            )
        ],
    );
    expect(
        $runner->logs()
    )->toBeArray()->toBeEmpty();

    $runner->run();

    expect(
        $runner->logs()
    )->toBeArray()->toEqual([
        'test' => [
            'message' => 'test',
            'number' => 10,
            'option' => true
        ],
        'another' => 'test',
    ]);
});

it('throws a workflow exception if target class does not exist', function () {
    $runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make(
                payload: [
                    'name' => 'test',
                    'jobs' => [
                        'test' => [
                            'run' => [
                                'target' => 'Testing',
                                'method' => 'oops',
                                'args' => [
                                    'test',
                                ]
                            ]
                        ]
                    ]
                ]
            )
        ]
    );

    $runner->run();
})->throws(WorkflowException::class, "Workflow target [Testing] does not exist");

it('throws a workflow exception if method does not exist on target class', function () {
    $runner = WorkflowRunner::build(
        workflows: [
           WorkflowBuilder::make(
               payload: [
                    'name' => 'test',
                    'jobs' => [
                        'test' => [
                            'run' => [
                                'target' => \JustSteveKing\Workflow\Stubs\Test::class,
                                'method' => 'oops',
                                'args' => [
                                    'test',
                                ]
                            ]
                        ]
                    ]
                ]
           )
       ]
    );

    $runner->run();
})->throws(WorkflowException::class, "[oops] does not exist on target [JustSteveKing\Workflow\Stubs\Test]");

it('throws a workflow exception if the target class cannot be instantiated', function () {
    $runner = WorkflowRunner::build(
        workflows: [
           WorkflowBuilder::make(
               payload: [
                    'name' => 'test',
                    'jobs' => [
                        'test' => [
                            'run' => [
                                'target' => \JustSteveKing\Workflow\Stubs\FailingTest::class,
                                'method' => 'run',
                                'args' => [
                                    'test',
                                ]
                            ]
                        ]
                    ]
                ]
           )
       ]
    );

    $runner->run();
})->throws(WorkflowException::class, "Cannot construct [JustSteveKing\Workflow\Stubs\FailingTest]");

