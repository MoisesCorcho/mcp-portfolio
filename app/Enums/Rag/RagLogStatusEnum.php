<?php

declare(strict_types=1);

namespace App\Enums\Rag;

enum RagLogStatusEnum: string
{
    case Completed = 'completed';
    case Blocked = 'blocked';
    case Error = 'error';
}
