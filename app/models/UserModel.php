<?php
declare(strict_types=1);

namespace App\Models;
use App\Interface\ModelInterface;

class UserModel implements ModelInterface{
    public string $name;
    public string $email;
    public string $password;
    public string $role;

    public static function getModelName():string
    {
        return 'users';
    }



}