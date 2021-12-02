# Workflow

[![Tests](https://github.com/JustSteveKing/workflow/actions/workflows/test.yml/badge.svg?branch=main)](https://github.com/JustSteveKing/workflow/actions/workflows/test.yml)

This package is aimed to be a simplistic PHP workflow package that works in a similar fashion to GitHub Actions.

## Installation

To install this package, use the following composer command:

```bash
composer require juststeveking/workflow
```

## Usage

To create a new Workflow Runner, all you need to do is build it. It will take an optional array of Workflows for you to pass in, 
or you can allow it to default to empty to programatically build it yourself.

### Building a Workflow Runner without Workflows

```php
use JustSteveKing\Workflow\WorkflowRunner;

$runner = WorkflowRunner::build();
```

### Building a Workflow Runner with a Workflow

```php
use JustSteveKing\Workflow\WorkflowRunner;

$runner = WorkflowRunner::build(
    workflows: [
        WorkflowBuilder::make(
            payload: JsonLoader::load(__DIR__ . '/path/to/workflow.json')
        )
    ]
);
```

## Building a Workflow

To build a workflow you can use either a `YAML` file or a `JSON` file:

### Example YAML Workflow File

```yaml
name: 'test'

jobs:
  test:
    run:
      target: JustSteveKing\Workflow\Stubs\Test
      method: run
      args:
        - 'test'
        - 10
        - true

  another:
    run:
      target: JustSteveKing\Workflow\Stubs\Test
      method: another
      args:
        - 'test'
```

### Example JSON Workflow File

```json
{
  "name": "test",
  "jobs": {
    "test": {
      "run": {
        "target": "JustSteveKing\\Workflow\\Stubs\\Test",
        "method": "run",
        "args": [
          "test",
          10,
          true
        ]
      }
    },
    "another": {
      "run": {
        "target": "JustSteveKing\\Workflow\\Stubs\\Test",
        "method": "another",
        "args": [
          "test"
        ]
      }
    }
  }
}
```
You can pass these files into a WorkflowBuilder using the following approaches:

### JSON Workflow

```php
use JustSteveKing\Workflow\WorkflowBuilder;
use JustSteveKing\Workflow\Loaders\JsonLoader;

$workflow = WorkflowBuilder::make(
    payload: JsonLoader::load(__DIR__ . '/path/to/workflow.json')
);
```

### YAML Workflow

```php
use JustSteveKing\Workflow\WorkflowBuilder;
use JustSteveKing\Workflow\Loaders\YamlLoader;

$workflow = WorkflowBuilder::make(
    payload: YamlLoader::load(__DIR__ . '/path/to/workflow.yaml')
);
```

## Running a workflow

Once you have built up your Workflow runner - all you need to do is run it:

```php
use JustSteveKing\Workflow\WorkflowRunner;

$runner = WorkflowRunner::build(
    workflows: [
        WorkflowBuilder::make(
            payload: JsonLoader::load(__DIR__ . '/path/to/workflow.json')
        )
    ]
);

$runner->run();
```

Each Job for each workflow anythings returned will be added to an internal log on the runner allowing you to check that they ran. This can be accessed using:

```php
$runner->logs();
```
