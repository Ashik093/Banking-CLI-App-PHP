<?php
declare(strict_types=1);

if(!function_exists('getTxtModelFilePath')){
    function getTxtModelFilePath(string $file)
    {
        return 'file/model/'.$file.'.txt';
    }
}