<?php
declare(strict_types=1);

namespace App\Controller;
use App\Interface\StorageInterface;
use App\Models\UserModel;
use App\Services\AuthService;

class UserController {
    private StorageInterface $storageInterface;
    private array $data;
    public function __construct(StorageInterface $storageInterface)
    {
        $this->storageInterface = $storageInterface;
        $this->data = $this->storageInterface->getAll(UserModel::getModelName())->data;
    }

    public function getAllCustomer():array
    {
         return $this->data;

    }

    public function register(array $data):void
    {  
        if($this->storageInterface->where('email',$data['email'])->data){
            print("Email already exist in our records.\n");
        }else{
            $this->store($data);
            print("Customer registration success. Please login.\n");
        }

    }


    public function login(array $data):void
    {  
        if($this->storageInterface->where('email',$data['email'])->where('password',md5(trim($data['password']," ")))->data){
            AuthService::authSet($this->storageInterface->where('email',$data['email'])->where('password',md5(trim($data['password']," ")))->data);
            print("Login success.\n");
        }else{
            print("Wrong credentials.\n");
        }

    }

    public function store(array $data):bool
    {   
         $user = new UserModel();
         $user->name = $data['name'];
         $user->email = $data['email'];
         $user->password = md5(trim($data['password'],' '));
         $user->role =$data['role'];

         $this->data[] = $user;
         $this->storageInterface->save($this->data,UserModel::getModelName());

         return true;

    }

}