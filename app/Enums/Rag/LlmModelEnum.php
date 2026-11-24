<?php

declare(strict_types=1);

namespace App\Enums\Rag;

enum LlmModelEnum: string
{
    case Gpt4oMini = 'gpt-4o-mini';
    case Gpt4o = 'gpt-4o';
}
