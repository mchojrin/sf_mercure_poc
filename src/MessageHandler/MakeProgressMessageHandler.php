<?php

namespace App\MessageHandler;

use App\Message\FinishProcessMessage;
use App\Message\MakeProgressMessage;
use DateTimeImmutable;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final readonly class MakeProgressMessageHandler
{
    public function __construct(private HubInterface $hub, private MessageBusInterface $messageBus){}

    public function __invoke(MakeProgressMessage $message): void
    {
        sleep(rand(0, 2));
        $newPercentage = rand($message->getCurrentPercentage(), 100);
        $this->hub->publish(
            new Update(
                'https://my_app/long_process',
                json_encode(
                    [
                        'description' => 'Process at ' . $newPercentage . '%',
                        'timestamp' => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
                    ])
            )
        );

        $this->messageBus->dispatch($newPercentage < 100 ? new MakeProgressMessage($newPercentage) : new FinishProcessMessage());
    }
}
