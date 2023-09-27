<?php
declare(strict_types=1);

namespace App\Services;

use App\Interface\StorageInterface;

class TxtFileStorageService implements StorageInterface{

    public array $data=[];
    public function save(array $data,string $model):void
    {
        file_put_contents(getTxtModelFilePath($model),serialize($data));
    }
    
    public function getAll(string $model):object
    {
        if (file_exists(getTxtModelFilePath($model))) {
            $this->data = unserialize(file_get_contents(getTxtModelFilePath($model)));
        }
        return $this;
    }
    public function where(string $property,mixed $value):object
    {
        $this->data = array_filter($this->data,function($data)use($property,$value){
            return $data->{$property} == $value;
        });
        return $this;
    
    }
}