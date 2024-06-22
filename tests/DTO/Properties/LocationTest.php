<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusKlaviyoPlugin\DTO\Properties;

use Setono\SyliusKlaviyoPlugin\DTO\Properties\Location;
use Tests\Setono\SyliusKlaviyoPlugin\DTO\DTOTestCase;

/**
 * @covers \Setono\SyliusKlaviyoPlugin\DTO\Properties\Subscriptions
 */
final class LocationTest extends DTOTestCase
{
    protected function getDTO(): Location
    {
        $properties = $this->propertiesFactory->create(Location::class);
        $properties->address1 = 'Test';
        $properties->zip = '98612';
        $properties->city = 'Portland';
        $properties->region = 'Oregon';
        $properties->country = 'US';

        return $properties;
    }

    protected function getExpectedData(): array
    {
        return [
            'address1' => 'Test',
            'city' => 'Portland',
            'country' => 'US',
            'region' => 'Oregon',
            'zip' => '98612',
        ];
    }
}
