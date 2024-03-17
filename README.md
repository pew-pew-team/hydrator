<p align="center">
    <a href="https://github.com/pew-pew-team"><img src="https://raw.githubusercontent.com/pew-pew-team/.github/master/assets/logo.svg" width="128" height="128" /></a>
</p>

<p align="center">
    <a href="https://packagist.org/packages/pew-pew/hydrator"><img src="https://poser.pugx.org/pew-pew/hydrator/require/php?style=for-the-badge" alt="PHP 8.3+"></a>
    <a href="https://packagist.org/packages/pew-pew/hydrator"><img src="https://poser.pugx.org/pew-pew/hydrator/version?style=for-the-badge" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/pew-pew/hydrator"><img src="https://poser.pugx.org/pew-pew/hydrator/v/unstable?style=for-the-badge" alt="Latest Unstable Version"></a>
    <a href="https://raw.githubusercontent.com/pew-pew-team/hydrator/blob/master/LICENSE"><img src="https://poser.pugx.org/pew-pew/hydrator/license?style=for-the-badge" alt="License MIT"></a>
</p>
<p align="center">
    <a href="https://github.com/pew-pew-team/hydrator/actions"><img src="https://github.com/pew-pew-team/hydrator/workflows/tests/badge.svg"></a>
    <a href="https://github.com/pew-pew-team/hydrator/actions"><img src="https://github.com/pew-pew-team/hydrator/workflows/codestyle/badge.svg"></a>
    <a href="https://github.com/pew-pew-team/hydrator/actions"><img src="https://github.com/pew-pew-team/hydrator/workflows/security/badge.svg"></a>
    <a href="https://github.com/pew-pew-team/hydrator/actions"><img src="https://github.com/pew-pew-team/hydrator/workflows/static-analysis/badge.svg"></a>
</p>

# Hydrator

A set of interfaces for mapping arbitrary values to their typed equivalents
and their inverses.

## Installation

PewPew Hydrator is available as Composer repository and can be installed using 
the following command in a root of your project:

```bash
$ composer require pew-pew/hydrator
```

More detailed installation [instructions are here](https://getcomposer.org/doc/01-basic-usage.md).

## Usage

```php
$hydrator = new class implements \PewPew\Hydrator\HydratorInterface {
    public function hydrate(string $type, mixed $data): mixed
    {
         return ...;
    }
};

$hydrator = new \PewPew\Hydrator\TraceableHydrator(
    hydrator: $hydrator,
    stopwatch: new \Symfony\Component\Stopwatch\Stopwatch(),
);

$hydrator = new \PewPew\Hydrator\LoggableHydrator(
    hydrator: $hydrator,
    logger: new ExampleLogger(),
);
```
