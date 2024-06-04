<?php

namespace App\MessageHandler;

use App\Message\MakeProgressMessage;
use App\Message\StartProcessMessage;
use DateTime;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final readonly class StartProcessMessageHandler
{
    public function __construct(private HubInterface $hub, private MessageBusInterface $messageBus){}

    public function __invoke(StartProcessMessage $message): void
    {
        $this->messageBus->dispatch(new MakeProgressMessage(0));

        $this->hub->publish(
            new Update(
                'https://my_app/long_process',
                json_encode(
                    [
                        'description' => 'Process started',
                        'timestamp' => (new DateTime())->format('Y-m-d H:i:s'),
                    ])
            )
        );
    }
}
