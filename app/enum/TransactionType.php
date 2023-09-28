<?php
declare(strict_types=1);

namespace App\Enum;

enum TransactionType{
    case DEPOSIT;
    case WITHDRAW;
    case TRANSFER;
    public function toString(): string {
        switch ($this) {
            case self::DEPOSIT:
                return 'DEPOSIT';
            case self::WITHDRAW:
                return 'WITHDRAW';
            default:
                return 'TRANSFER';
        }
    }
}