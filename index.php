<?php
require_once 'vendor/autoload.php';

use App\Command\CommandLine;
use App\Controller\TransactionController;
use App\Services\TxtFileStorageService;


// $app = new CommandLine();
// $app->run();
$txtFile = new TxtFileStorageService();
$transaction = new TransactionController($txtFile);
var_dump($transaction->getAllTransaction());

