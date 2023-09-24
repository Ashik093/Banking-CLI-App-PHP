<?php
declare(strict_types=1);
namespace App\Command;
use App\Controller\UserController;
use App\Enum\Role;
use App\Services\TxtFileStorageService;
class CommandLine{
    private const REGISTER=1;
    private const LOGIN=2;
    private array $initialViewOptions = [
        self::REGISTER=>"Register",
        self::LOGIN=>"Login",
    ];

    public function run()
    {
        $storage = new TxtFileStorageService();
        while(true)
        {
            foreach($this->initialViewOptions as $id=>$label){
                printf("%d. %s\n", $id, $label);
            }
            $choice = (int)(readline("Enter Your Choice: "));
            switch ($choice) {
                case self::REGISTER:
                    $name = readline("Enter your name: ");
                    $email = trim(readline("Enter your email: "));
                    $password = trim(readline("Enter your password: "));
                    $user = new UserController($storage);
                    $user->register(["name"=>$name,"email"=>$email,"password"=>$password,"role"=>Role::CUSTOMER]);
                    break;
                case self::LOGIN:
                    $email = trim(readline("Enter your email: "));
                    $password = trim(readline("Enter your password: "));
                    $user = new UserController($storage);
                    $user->login(["email"=>$email,"password"=>$password]);
                     break;
                default:
                    print("Invalid Option\n");
                    break;
            }
        }

    }
}