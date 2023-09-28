<?php
declare(strict_types=1);
namespace App\Command;

use App\Controller\UserController;
use App\Interface\CommandLineInterface;
use App\Services\TxtFileStorageService;
use App\Controller\TransactionController;

class AdminCommandLine implements CommandLineInterface
{
    private const ALL_CUSTOMER = 1;
    private const TRANSACTION_BY_USER = 2;
    private const TRANSACTION_OF_ALL_USER = 3;
    private array $viewOptions = [
        self::ALL_CUSTOMER=> "See the list of all the customers",
        self::TRANSACTION_BY_USER => "See transactions by a specific user",
        self::TRANSACTION_OF_ALL_USER => "See the transaction of all the customers",
    ];

    public function __construct(private TxtFileStorageService $storage)
    {

    }
    public function fire():void
    {

        foreach ($this->viewOptions as $id => $label) {
            printf("%d. %s\n", $id, $label);
        }
        $choice = (int) (readline("Enter Your Choice: "));
        switch ($choice) {
            case self::ALL_CUSTOMER:
                $user = new UserController($this->storage);
                $data = $user->getAllCustomer();
                echo "Name   Email".PHP_EOL;
                foreach($data as $row){
                    echo $row->name."   ".$row->email.PHP_EOL; 
                }
                break;
            case self::TRANSACTION_BY_USER:
                $email = trim(readline("Enter customer email: "));
                $transaction = new TransactionController($this->storage);
                $data = $transaction->getUserTransaction($email);
                echo "Amount   Transaction Type   Entry Type   Email   Date   TransferedBy   TransferedTo".PHP_EOL;
                foreach($data as $row){
                    echo $row->amount."   ".$row->transactionType->toString()."   ". $row->entryType->toString()."   ".$row->email."   ",$row->date."   ".$row->transferedBy."  ".$row->transferedTo.PHP_EOL;
                   
                }
                break;
            case self::TRANSACTION_OF_ALL_USER:
                $transaction = new TransactionController($this->storage);
                $data = $transaction->get();
                echo "Amount   Transaction Type   Entry Type   Email   Date   TransferedBy   TransferedTo".PHP_EOL;
                foreach($data as $row){
                    echo $row->amount."   ".$row->transactionType->toString()."   ". $row->entryType->toString()."   ".$row->email."   ",$row->date."   ".$row->transferedBy."  ".$row->transferedTo.PHP_EOL;
                   
                }
                break;
            default:
                print("Invalid Option\n");
                break;
        }


    }
}