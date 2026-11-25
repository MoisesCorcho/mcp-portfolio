<?php

declare(strict_types=1);

namespace App\Enums\Rag;

enum RagDocumentTypeEnum: string
{
    case Project = 'project';
    case Experience = 'experience';
    case Skill = 'skill';
    case General = 'general';
}
