<?php

declare(strict_types=1);

namespace App\Enums\Rag;

enum MessageRoleEnum: string
{
    case System = 'system';
    case User = 'user';
    case Assistant = 'assistant';
}
