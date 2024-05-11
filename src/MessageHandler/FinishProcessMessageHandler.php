<?php

namespace App\MessageHandler;

use App\Message\FinishProcessMessage;
use DateTimeImmutable;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final class FinishProcessMessageHandler
{
    public function __construct(private HubInterface $hub, private MessageBusInterface $messageBus)
    {
    }

    public function __invoke(FinishProcessMessage $message)
    {
        $this->hub->publish(new Update(
            'https://my_app/long_process',
            json_encode(
                [
                    'description' => 'Process finished',
                    'timestamp' => $this->getTimeStamp(),
                ])
        ));
    }

    private function getTimeStamp(): string
    {
        return (new DateTimeImmutable())->format('Y-m-d H:i:s');
    }
}
