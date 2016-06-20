<?php

/*
 * copied autoload function from ( function is by PSR-0 standard ):
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
 */



function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', '/', $namespace) . '/';
    }
    $fileName .= str_replace('_', '/', $className) . '.php';

    require $fileName;
}
spl_autoload_register('autoload');

?>

