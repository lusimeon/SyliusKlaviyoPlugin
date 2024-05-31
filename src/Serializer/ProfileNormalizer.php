<?php

namespace Setono\SyliusKlaviyoPlugin\Serializer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Setono\SyliusKlaviyoPlugin\DTO\Properties\CustomerProperties;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ProfileNormalizer implements ContextAwareNormalizerInterface
{
    public function __construct(
        private readonly ObjectNormalizer $normalizer,
    )
    {
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CustomerProperties;
    }

    /**
     * @param CustomerProperties $topic
     */
    public function normalize($topic, ?string $format = null, array $context = [])
    {
        return [
            'type' => 'profile',
            'attributes' => $this->normalizer->normalize($topic, $format, $context),
        ];
    }
}
