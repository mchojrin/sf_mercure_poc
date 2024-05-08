<?php

namespace App\EventListener;

use App\Event\ProcessStartEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsEventListener]
class ProcessStartListener
{
        public function __construct(private KernelInterface $kernel, private HubInterface $hub) {}

    public function __invoke(ProcessStartEvent $event): void
    {
            $update = new Update(
                'https://my_app/long_process',
		json_encode(
			[
				'description' => 'Process started',
				'timestamp' => $event->getTimeStamp(),
			])
                );

	    $this->hub->publish($update);
	    file_put_contents($this->kernel->getProjectDir().DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'process.lock', "Processing...");
    }
}
