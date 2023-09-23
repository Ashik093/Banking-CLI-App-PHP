<?php
declare(strict_types=1);

namespace App\Controller;
use App\Interface\StorageInterface;
use App\Models\UserModel;

class UserController {
    private StorageInterface $storageInterface;
    private array $data;
    public function __construct(StorageInterface $storageInterface)
    {
        $this->storageInterface = $storageInterface;
    }

    public function store(array $data):void
    {
         $user = new UserModel();
         $user->name = $data['name'];
         $user->email = $data['email'];
         $user->password = md5(trim($data['password'],' '));
         $user->role =$data['role'];

         $this->data[] = $user;

         $this->storageInterface->save($this->data,UserModel::getModelName());

    }
}