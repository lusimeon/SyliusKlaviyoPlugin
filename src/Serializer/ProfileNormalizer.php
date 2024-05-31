<?php

declare(strict_types=1);

namespace Setono\SyliusKlaviyoPlugin\Serializer;

use Setono\SyliusKlaviyoPlugin\DTO\Properties\CustomerProperties;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ProfileNormalizer implements NormalizerInterface
{
    public function __construct(
        private readonly ObjectNormalizer $normalizer,
    ) {
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof CustomerProperties;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = [])
    {
        return [
            'type' => 'profile',
            'attributes' => $this->normalizer->normalize($object, $format, $context),
        ];
    }
}
