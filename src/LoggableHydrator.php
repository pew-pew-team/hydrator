<?php

declare(strict_types=1);

namespace PewPew\Hydrator;

use Psr\Log\LoggerInterface;

/**
 * @api
 */
final readonly class LoggableHydrator implements HydratorInterface
{
    public function __construct(
        private HydratorInterface $hydrator,
        private LoggerInterface $logger,
    ) {}

    public function hydrate(string $type, mixed $data): mixed
    {
        try {
            /** @var mixed $result */
            $result = $this->hydrator->hydrate($type, $data);

            $this->logger->debug('Hydration {type}', [
                'type' => $type,
                'input' => $data,
                'output' => $result,
            ]);
        } catch (\Throwable $e) {
            $this->logger->debug('Failed hydration {type}', [
                'type' => $type,
                'input' => $data,
                'error' => $e,
            ]);

            throw $e;
        }

        /** @psalm-suppress MixedReturnStatement */
        return $result;
    }
}
