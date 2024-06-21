<?php

declare(strict_types=1);

namespace Setono\SyliusKlaviyoPlugin\DTO\Properties;

abstract class Properties extends Base
{
    /**
     * The name of the associated event, i.e. 'Viewed Product'
     */
    public string $event;

    public ?string $eventId = null;

    public ?float $value = null;
}
