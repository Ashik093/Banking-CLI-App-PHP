<?php
declare(strict_types=1);
namespace App\Command;
use App\Services\AuthService;
use App\Services\TxtFileStorageService;

class AppCommandLine{
    public function run():void
    {
        AuthService::logout();
        $storage = new TxtFileStorageService();
        while(true)
        {
            if(AuthService::authCheck()){
                $name = readline("Enter your name: ");
            }else{
                $guset = new GuestCommandLine($storage);
                $guset->fire();
            }
            

        }

    }
}