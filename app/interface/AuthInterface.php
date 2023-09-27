<?php
declare(strict_types=1);

namespace App\Interface;
interface AuthInterface{
    public static function authCheck(string $model):bool;
    public static function authSet(array $data,string $model):bool;
    public static function logout(string $model):bool;
    public static function currentAuthData(string $model):array;
}