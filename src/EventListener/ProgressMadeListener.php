<?php

namespace App\EventListener;

use App\Event\ProgressMadeEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsEventListener]
class ProgressMadeListener
{
        public function __construct(private KernelInterface $kernel, private HubInterface $hub) {}

    public function __invoke(ProgressMadeEvent $event): void
    {
            $update = new Update(
                'https://my_app/long_process',
		json_encode(
			[
				'description' => $event->getPercentage().'% of the process completed',
				'timestamp' => $event->getTimeStamp(),
			])
                );

	    $this->hub->publish($update);
    }
}
