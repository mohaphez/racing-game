<?php

declare(strict_types=1);

namespace App\Support;

use cli\Streams;

class Support
{
    public static function clearScreen(): void
    {
        if (Streams::isTty()) {
            Streams::out("\033c");
        }
    }
}