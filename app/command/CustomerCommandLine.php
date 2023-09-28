<?php
declare(strict_types=1);
namespace App\Command;

use App\Enum\Role;
use App\Services\AuthService;
use App\Controller\UserController;
use App\Interface\CommandLineInterface;
use App\Services\TxtFileStorageService;
use App\Controller\TransactionController;

class CustomerCommandLine implements CommandLineInterface
{
    private const TRANSACTION = 1;
    private const DEPOSIT = 2;
    private const WITHDRAW = 3;
    private const TRANSFER = 4;
    private const BALANCE = 5;
    private array $viewOptions = [
        self::TRANSACTION=> "See transactions",
        self::DEPOSIT => "Deposit",
        self::WITHDRAW => "Withdraw",
        self::TRANSFER => "Transfer money",
        self::BALANCE => "Balance",
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
            case self::TRANSACTION:
                $transaction = new TransactionController($this->storage);
                $data = $transaction->getUserTransaction(AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->email);
                echo "Amount   Transaction Type   Entry Type   Email   Date   TransferedBy   TransferedTo".PHP_EOL;
                foreach($data as $row){
                    echo $row->amount."   ".$row->transactionType->toString()."   ". $row->entryType->toString()."   ".$row->email."   ",$row->date."   ".$row->transferedBy."  ".$row->transferedTo.PHP_EOL;
                   
                }
                break;
            case self::DEPOSIT:
                $amount = (float)(readline("Enter your deposit amount: "));
                $transaction = new TransactionController($this->storage);
                $transaction->deposit(["amount"=>$amount]);
                break;
            case self::WITHDRAW:
                $amount = (float)(readline("Enter your withdraw amount: "));
                $transaction = new TransactionController($this->storage);
                $transaction->withdraw(["amount"=>$amount]);
                break;
            case self::TRANSFER:
                $amount = (float)(readline("Enter amount: "));
                $email = trim(readline("Enter account email: "));
                $transaction = new TransactionController($this->storage);
                $transaction->transfer(["amount"=>$amount,'transferedToEmail'=>$email]);
                break;
            case self::BALANCE:
                $transaction = new TransactionController($this->storage);
                $balance = $transaction->balance(AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->email);
                echo "Your current balance: ".$balance.PHP_EOL;
                break;
            default:
                print("Invalid Option\n");
                break;
        }


    }
}