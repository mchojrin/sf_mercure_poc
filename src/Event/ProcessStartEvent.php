<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use DateTimeInterface;

/**
 * This event is dispatched each time an order
 * is placed in the system.
 */
final class ProcessStartEvent extends Event
{
	public const NAME = 'long_process.started';

    public function __construct(private DateTimeInterface $timestamp) {}

    public function getTimeStamp(): DateTimeInterface 
    {
        return $this->timestamp;
    }
}
