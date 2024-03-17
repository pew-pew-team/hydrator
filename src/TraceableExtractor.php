<?php

declare(strict_types=1);

namespace PewPew\Hydrator;

use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @api
 */
final readonly class TraceableExtractor implements ExtractorInterface
{
    public function __construct(
        private ExtractorInterface $extractor,
        private Stopwatch $stopwatch,
    ) {}

    public function extract(mixed $data): mixed
    {
        $type = \get_debug_type($data);
        $event = $this->stopwatch->start("Extract $type", 'hydrator');

        try {
            /** @var mixed $result */
            $result = $this->extractor->extract($data);
        } catch (\Throwable $e) {
            $event->stop();

            throw $e;
        }

        $event->stop();

        return $result;
    }
}
