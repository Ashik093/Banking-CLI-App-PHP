<?php
namespace App\Models;
use App\Enum\EntryType;
use App\Enum\TransactionType;
use App\Interface\ModelInterface;

class TransactionModel implements ModelInterface{

    public float $amount;
    public string $email;
    public string $date;
    public TransactionType $transactionType;
    public EntryType $entryType;
    public string $transferedBy;
    public string $transferedTo;
    public static function getModelName():string
    {
        return 'transactions';
    }
}