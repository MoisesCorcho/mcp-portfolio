<?php

declare(strict_types=1);

namespace App\DTOs\Rag;

use App\Enums\Rag\MessageRoleEnum;

final readonly class ChatMessageDTO
{
    public function __construct(
        public MessageRoleEnum $role,
        public string $content,
    ) {}
}
