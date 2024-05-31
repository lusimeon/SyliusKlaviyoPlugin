<?php

namespace Setono\SyliusKlaviyoPlugin\Serializer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Setono\SyliusKlaviyoPlugin\DTO\Event;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class EventNormalizer implements ContextAwareNormalizerInterface
{
    public function __construct(
        private readonly ObjectNormalizer $normalizer,
        private readonly ProfileNormalizer $profileNormalizer,
    )
    {
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Event;
    }

    /**
     * @param Event $topic
     */
    public function normalize($topic, ?string $format = null, array $context = [])
    {
        return [
            'type' => 'event',
            'attributes' => [
                'profile' => [
                    'data' => $this->profileNormalizer->normalize($topic->customerProperties, $format, $context),
                ],
                'metric' => [
                    'data' => [
                        'type' => 'metric',
                        'attributes' => [
                            'name' => $topic->event,
                        ],
                    ]
                ],
                'time' => date('c', $topic->timestamp),
                'unique_id' => $topic->properties->eventId,
                'value' => $topic->properties->value,
                'properties' => $this->normalizer->normalize($topic->properties, $format, $context),
            ]
        ];
    }
}
