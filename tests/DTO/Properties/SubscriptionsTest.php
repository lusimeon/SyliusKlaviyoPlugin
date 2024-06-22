<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusKlaviyoPlugin\DTO\Properties;

use Setono\SyliusKlaviyoPlugin\DTO\Properties\Subscriptions;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Tests\Setono\SyliusKlaviyoPlugin\DTO\DTOTestCase;

/**
 * @covers \Setono\SyliusKlaviyoPlugin\DTO\Properties\Subscriptions
 */
final class SubscriptionsTest extends DTOTestCase
{
    protected function getDTO(): Subscriptions
    {
        $properties = $this->propertiesFactory->create(Subscriptions::class);
        $properties->emailMarketingSubscribe();
        $properties->smsMarketingSubscribe();

        return $properties;
    }

    protected function normalize(object $obj): array
    {
        $data = $this->getSerializer()->normalize($obj, null, [
            AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
            'groups' => 'setono:sylius-klaviyo:subscription',
        ]);

        self::assertIsArray($data);

        return $data;
    }

    protected function getExpectedData(): array
    {
        return [
            'email' => ['marketing' => ['consent' => Subscriptions::CONSENT_SUBSCRIBED]],
            'sms' => ['marketing' => ['consent' => Subscriptions::CONSENT_SUBSCRIBED]],
        ];
    }
}
