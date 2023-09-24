<?php
use App\Controller\UserController;
use App\Services\TxtFileStorageService;

require_once 'vendor/autoload.php';

$user = new UserController((new TxtFileStorageService()));

// $user->store([
//     "name" => "rounak",
//     "email" => "ashik@gmail.com",
//     "password" => "123456",
//     "role" =>"customer"
// ]);
// var_dump($user->get());

$user->getSingleItem();
var_dump($user->get());
