<?php

namespace App\MessageHandler;

use App\Message\FinishProcessMessage;
use DateTimeImmutable;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class FinishProcessMessageHandler
{
    public function __construct(private HubInterface $hub){}

    public function __invoke(FinishProcessMessage $message): void
    {
        $this->hub->publish(new Update(
            'https://my_app/long_process',
            json_encode(
                [
                    'description' => 'Process finished',
                    'timestamp' => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
                ])
        ));
    }

}
