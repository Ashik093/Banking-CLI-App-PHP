<?php
declare(strict_types=1);
namespace App\Command;

use App\Enum\Role;
use App\Controller\UserController;
use App\Interface\CommandLineInterface;
use App\Services\TxtFileStorageService;

class GuestCommandLine implements CommandLineInterface
{
    private const REGISTER = 1;
    private const LOGIN = 2;
    private array $viewOptions = [
        self::REGISTER=> "Register",
        self::LOGIN => "Login",
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
            case self::REGISTER:
                $name = readline("Enter your name: ");
                $email = trim(readline("Enter your email: "));
                $password = trim(readline("Enter your password: "));
                $user = new UserController($this->storage);
                $user->register(["name" => $name, "email" => $email, "password" => $password, "role" => Role::CUSTOMER]);
                break;
            case self::LOGIN:
                $email = trim(readline("Enter your email: "));
                $password = trim(readline("Enter your password: "));
                $user = new UserController($this->storage);
                $user->login(["email" => $email, "password" => $password]);
                break;
            default:
                print("Invalid Option\n");
                break;
        }


    }
}