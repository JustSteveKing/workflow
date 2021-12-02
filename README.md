# Workflow

This package is aimed to be a simplistic PHP workflow package that works in a similar fashion to GitHub Actions.

## Installation



## Usage

```php
$runner = WorkflowRunner::build();

$runner->add(Workflow::make(__DIR__ . '/test.yaml'));

$runner->run();
```
