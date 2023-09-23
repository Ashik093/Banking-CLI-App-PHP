<?php
declare(strict_types=1);

namespace App\Services;

use App\Interface\StorageInterface;

class TxtFileStorageService implements StorageInterface{
    public function save(array $data,string $model):void
    {
        $file = fopen(getTxtModelFilePath($model), 'a+');
        if ($file) {
            fwrite($file, serialize($data));
            fclose($file);
        } else {
            file_put_contents(getTxtModelFilePath($model),serialize($data));
        } 
    }

    public function getAll():array
    {
        return [];
    }
    public function getOne():array
    {
        return [];
    }
    public function where(string $property,mixed $value):array
    {
        return [];
    }
}