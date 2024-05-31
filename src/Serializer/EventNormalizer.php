<?php

declare(strict_types=1);

namespace Setono\SyliusKlaviyoPlugin\Serializer;

use Setono\SyliusKlaviyoPlugin\DTO\Event;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class EventNormalizer implements NormalizerInterface
{
    public function __construct(
        private readonly ObjectNormalizer $normalizer,
        private readonly ProfileNormalizer $profileNormalizer,
    ) {
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof Event;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = [])
    {
        return [
            'type' => 'event',
            'attributes' => [
                'profile' => [
                    'data' => $this->profileNormalizer->normalize($object->customerProperties, $format, $context),
                ],
                'metric' => [
                    'data' => [
                        'type' => 'metric',
                        'attributes' => [
                            'name' => $object->event,
                        ],
                    ],
                ],
                'time' => date('c', $object->timestamp),
                'unique_id' => $object->properties->eventId,
                'value' => $object->properties->value,
                'properties' => $this->normalizer->normalize($object->properties, $format, $context),
            ],
        ];
    }
}
