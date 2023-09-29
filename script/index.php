<?php

use App\Script\AdminScript;
use App\Services\TxtFileStorageService;

require_once 'vendor/autoload.php';
$storage = new TxtFileStorageService();

$app = new AdminScript($storage);
$app->fire();