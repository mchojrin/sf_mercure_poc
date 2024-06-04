<?php

namespace App\Message;

final readonly class MakeProgressMessage
{
     public function __construct(private int $currentPercentage) {
     }

    public function getCurrentPercentage(): int
    {
        return $this->currentPercentage;
    }
}
