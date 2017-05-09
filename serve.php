<?php

/**
 * Mustache Integrated Server
 *
 * use $ php -S 127.0.0.1:8888 server.php
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false; // TODO: Por algum motivo, ele identifica os arquivos de Assets mas não consegue carregalos - Já tentei usando file_get_content sem sucesso.
}
$_GET['path'] = substr($uri, 1); // Force the creation of the request path

require_once __DIR__. '/public/index.php';