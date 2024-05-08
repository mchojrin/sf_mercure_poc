<?php

namespace App\EventListener;

use App\Event\ProcessFinishEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsEventListener]
class ProcessFinishListener
{
        public function __construct(private KernelInterface $kernel, private HubInterface $hub) {}

    public function __invoke(ProcessFinishEvent $event): void
    {
            $update = new Update(
                'https://my_app/long_process',
		json_encode(
			[
				'description' => 'Process ended',
				'timestamp' => $event->getTimeStamp(),
			])
                );

	    $this->hub->publish($update);
	    unlink($this->kernel->getProjectDir().DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'process.lock');
    }
}
