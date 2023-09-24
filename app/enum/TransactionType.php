<?php
declare(strict_types=1);

namespace App\Enum;

enum TransactionType{
    case DEPOSIT;
    case WITHDRAW;
    case TRANSFER;
}