<?php

namespace App\Enums;

enum DelayStatus: string
{
    case InProgress = 'IN_PROGRESS';
    case Done       = 'DONE';
}
