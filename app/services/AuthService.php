<?php
declare(strict_types=1);

namespace App\Services;

use App\Interface\AuthInterface;

class AuthService implements AuthInterface{

    public static function authCheck(string $model="sessions"):bool
    {
        if (file_exists(getTxtModelFilePath($model))) {
            return unserialize(file_get_contents(getTxtModelFilePath($model)))?true:false;
        }
        return false;
    }
    public static function authSet(array $data,string $model="sessions"):bool
    {
        file_put_contents(getTxtModelFilePath($model),serialize($data));
        return true;
    }
    public static function logout(string $model="sessions"):bool
    {
        file_put_contents(getTxtModelFilePath($model),'');
        return true;
    }
    public static function currentAuthData(string $model="sessions"):array
    {
        if (file_exists(getTxtModelFilePath($model))) {
            return unserialize(file_get_contents(getTxtModelFilePath($model)));
        }
        return [];
    }
}