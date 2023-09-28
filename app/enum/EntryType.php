<?php
declare(strict_types=1);

namespace App\Enum;

enum EntryType{
    case DEBIT;
    case CREDIT;
    public function toString(): string {
        switch ($this) {
            case self::DEBIT:
                return 'DEBIT';
            default:
                return 'CREDIT';
        }
    }
}