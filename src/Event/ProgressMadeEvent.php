<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use DateTimeInterface;

/**
 * This event is dispatched each time an order
 * is placed in the system.
 */
final class ProgressMadeEvent extends Event
{
	public const NAME = 'long_process.progress_made';

    public function __construct(private DateTimeInterface $timeStamp, private float $percentage) {}

    public function getTimeStamp(): DateTimeInterface
    {
        return $this->timeStamp;
    }

	public function getPercentage(): float
	{
		return $this->percentage;
	}
}
