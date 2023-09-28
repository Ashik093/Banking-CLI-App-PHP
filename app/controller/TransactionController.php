<?php
declare(strict_types=1);

namespace App\Controller;
use App\Enum\EntryType;
use App\Enum\TransactionType;
use App\Models\TransactionModel;
use App\Interface\StorageInterface;
use App\Services\AuthService;


class TransactionController {
    private StorageInterface $storageInterface;
    private array $data;
    public function __construct(StorageInterface $storageInterface)
    {
        $this->storageInterface = $storageInterface;
        $this->data = $this->storageInterface->getAll(TransactionModel::getModelName())->data;
    }

    public function get():array
    {
         return $this->data;

    }

    public function getUserTransaction(string $email):array
    {
        return $this->storageInterface->where('email',$email)->data;
    }
    
    public function balance(string $email):float
    {
        $data = $this->getUserTransaction($email);
        $balance = 0.00;
        foreach($data as $row){
            $balance +=$row->amount;
        }
        return $balance;
    }

    public function deposit(array $data):void
    {
        $data['transferedBy'] = '';
        $data['transferedTo']='';
        $data['transactionType'] = TransactionType::DEPOSIT;
        $data['entryType'] = EntryType::CREDIT;
        $data['email'] = AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->email;
        $this->store($data);
        print("Your account credited. Amount: ".$data['amount']."\n");
    }

    public function withdraw(array $data):void
    {
        if($this->balance(AuthService::currentAuthData()[0]->email)>$data['amount']){
            $data['transferedBy']='';
            $data['transferedTo']='';
            $data['transactionType'] = TransactionType::WITHDRAW;
            $data['entryType'] = EntryType::DEBIT;
            $data['amount'] = -$data['amount'];
            $data['email'] = AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->email;
            $this->store($data);
            print("Your account debited. Amount: ".$data['amount']."\n");
        }else{
            print("Insufficient balance.\n");
        }
        
    }
    public function transfer(array $data):void
    {
        if($this->balance(AuthService::currentAuthData()[0]->email)>$data['amount']){
            $data['transferedBy']=AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->email;
            $data['transferedTo']=$data['transferedToEmail'];
            $data['transactionType'] = TransactionType::TRANSFER;
            $data['entryType'] = EntryType::DEBIT;
            $data['amount'] = -$data['amount'];
            $data['email'] = AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->email;
            $this->store($data);
    
            $data['entryType'] = EntryType::CREDIT;
            $data['amount'] = -$data['amount'];
            $data['email'] = $data['transferedToEmail'];
            $this->store($data);
            print("Fund transfer success. Amount: ".$data['amount']."\n");
        }else{
            print("Insufficient balance.\n");
        }
        
    }
    public function store(array $data):bool
    {   
         $transaction = new TransactionModel();
         $transaction->amount = $data['amount'];
         $transaction->email = $data['email'];
         $transaction->transferedBy = $data['transferedBy'];
         $transaction->transferedTo = $data['transferedTo'];
         $transaction->date = date('Y-m-d');
         $transaction->transactionType = $data['transactionType'];
         $transaction->entryType = $data['entryType'];
         $this->data[] = $transaction;
         $this->storageInterface->save($this->data,TransactionModel::getModelName());

         return true;

    }

}