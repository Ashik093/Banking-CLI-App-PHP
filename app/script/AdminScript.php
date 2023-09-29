<?php
declare(strict_types=1);
namespace App\Script;

use App\Enum\Role;
use App\Controller\UserController;
use App\Interface\CommandLineInterface;
use App\Services\TxtFileStorageService;

class AdminScript implements CommandLineInterface
{
    private const REGISTER_ADMIN = 1;
    private array $viewOptions = [
        self::REGISTER_ADMIN=> "Register New Admin"
    ];

    public function __construct(private TxtFileStorageService $storage)
    {

    }
    public function fire():void
    {

        while(true){
            foreach ($this->viewOptions as $id => $label) {
                printf("%d. %s\n", $id, $label);
            }
            $choice = (int) (readline("Enter Your Choice: "));
            switch ($choice) {
                case self::REGISTER_ADMIN:
                    $name = readline("Enter your name: ");
                    $email = trim(readline("Enter new admin email: "));
                    $password = trim(readline("Enter password: "));
                    $user = new UserController($this->storage);
                    $user->register(["name" => $name, "email" => $email, "password" => $password, "role" => Role::ADMIN]);
                    break;
                default:
                    print("Invalid Option\n");
                    break;
            }
        }


    }
}