<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use DateTimeInterface;

/**
 * This event is dispatched each time an order
 * is placed in the system.
 */
final class ProcessFinishEvent extends Event
{
	public const NAME = 'long_process.finished';

    public function __construct(private DateTimeInterface $timeStamp) {}

    public function getTimeStamp(): DateTimeInterface
    {
        return $this->timeStamp;
    }
}
