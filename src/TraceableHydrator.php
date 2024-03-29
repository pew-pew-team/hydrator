<?php

declare(strict_types=1);

namespace PewPew\Hydrator;

use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @api
 */
final readonly class TraceableHydrator implements HydratorInterface
{
    public function __construct(
        private HydratorInterface $hydrator,
        private Stopwatch $stopwatch,
    ) {}

    public function hydrate(string $type, mixed $data): mixed
    {
        $event = $this->stopwatch->start("Hydrate $type", 'hydrator');

        try {
            /** @var mixed $result */
            $result = $this->hydrator->hydrate($type, $data);
        } catch (\Throwable $e) {
            $event->stop();

            throw $e;
        }

        $event->stop();

        /** @psalm-suppress MixedReturnStatement */
        return $result;
    }
}
