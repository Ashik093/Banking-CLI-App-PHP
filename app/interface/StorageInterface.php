<?php
declare(strict_types=1);

namespace App\Interface;
interface StorageInterface{
    public function save(array $data, string $model):void;
    public function getAll(string $model):array;
    public function getOne():array;
    public function where(string $property,mixed $value):array;
}