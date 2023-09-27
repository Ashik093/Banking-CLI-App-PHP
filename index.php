<?php

require_once 'vendor/autoload.php';
use App\Command\AppCommandLine;


$app = new AppCommandLine();
$app->run();

