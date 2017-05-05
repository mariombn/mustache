<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

$_GET['path'] = substr($uri, 1); // Force the creation of the request path

require_once __DIR__. '/public/index.php';