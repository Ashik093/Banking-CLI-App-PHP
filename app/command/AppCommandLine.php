<?php
declare(strict_types=1);
namespace App\Command;
use App\Enum\Role;
use App\Services\AuthService;
use App\Command\AdminCommandLine;
use App\Command\CustomerCommandLine;
use App\Services\TxtFileStorageService;

class AppCommandLine{
    public function run():void
    {
        AuthService::logout();
        while(true)
        {
            $storage = new TxtFileStorageService();

            if(AuthService::authCheck() && AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->role==Role::ADMIN){
                $admin = new AdminCommandLine($storage);
                var_dump($admin->fire());
            }elseif(AuthService::authCheck() && AuthService::currentAuthData()[array_key_first(AuthService::currentAuthData())]->role==Role::CUSTOMER){
                $customer = new CustomerCommandLine($storage);
                $customer->fire();
            }else{
                $guset = new GuestCommandLine($storage);
                $guset->fire();
            }
            

        }

    }
}