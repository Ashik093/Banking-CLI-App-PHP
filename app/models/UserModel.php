<?php
declare(strict_types=1);

namespace App\Models;
use App\Enum\Role;
use App\Interface\ModelInterface;

class UserModel implements ModelInterface{
    public string $name;
    public string $email;
    public string $password;
    public Role $role;

    public static function getModelName():string
    {
        return 'users';
    }



}