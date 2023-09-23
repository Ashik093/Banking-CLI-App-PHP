<?php
use App\Controller\UserController;
use App\Services\TxtFileStorageService;

require_once 'vendor/autoload.php';

$user = new UserController((new TxtFileStorageService()));

$user->store([
    "name" => "Md Ashikur Rahman",
    "email" => "email@gmail.com",
    "password" => "123456",
    "role" =>"customer"
]);
