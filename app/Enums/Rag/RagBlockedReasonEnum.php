<?php

declare(strict_types=1);

namespace App\Enums\Rag;

enum RagBlockedReasonEnum: string
{
    case EmptyContext = 'empty_context';
}
