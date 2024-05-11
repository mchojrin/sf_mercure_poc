<?php

namespace App\Message;

final class MakeProgressMessage
{
     public function __construct(private int $currentPercentage) {
     }

    public function getCurrentPercentage(): int
    {
        return $this->currentPercentage;
    }

}
