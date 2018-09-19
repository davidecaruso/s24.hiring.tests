<?php
require_once 'vendor/autoload.php';

try {
    $path = new \Supermercato24\FileSystem\Path('/a/b/c/d');
    $path->cd('../x');
    echo $path->getCurrentPath();
} catch (Exception $e) {
    echo $e->getMessage();
}
