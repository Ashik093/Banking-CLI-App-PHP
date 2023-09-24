<?php
declare(strict_types=1);

namespace App\Controller;
use App\Enum\EntryType;
use App\Enum\TransactionType;
use App\Models\TransactionModel;
use App\Interface\StorageInterface;


class TransactionController {
    private StorageInterface $storageInterface;
    private array $data;
    public function __construct(StorageInterface $storageInterface)
    {
        $this->storageInterface = $storageInterface;
        $this->data = $this->storageInterface->getAll(TransactionModel::getModelName());
    }

    public function getAllTransaction():array
    {
         return $this->data;

    }
    public function store(array $data):bool
    {   
         $transaction = new TransactionModel();
         $transaction->amount = -100.00;
         $transaction->email = "ashik@gmail.com";
         $transaction->transferedBy = "";
         $transaction->date = date('Y-m-d');
         $transaction->transactionType = TransactionType::WITHDRAW;
         $transaction->entryType = EntryType::DEBIT;
         $this->data[] = $transaction;
         $this->storageInterface->save($this->data,TransactionModel::getModelName());

         return true;

    }

}