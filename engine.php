<?php
session_start();
define('ENGINE_START', microtime(true));
require_once APPPATH . '/vendor/autoload.php';

//Defini visualização de erros de acordo com o modo Debug true ou false
if (!defined('DEBUG') || DEBUG === FALSE) {
    error_reporting(0);
    ini_set("display_errors", 0);
} else {
    error_reporting(E_ALL & ~E_DEPRECATED);
    //error_reporting(E_ALL);
    ini_set("display_errors", 1);
}


//Define o número de parametros na URL
if (isset($_GET['path'])) {
    if (substr($_GET['path'], -1, 1) == '/') {
        $counturlpath = substr($_GET['path'], 0, -1);
    } else {
        $counturlpath = $_GET['path'];
    }
    $counturlpath = count(explode('/', $counturlpath));
} else {
    $counturlpath = 0;
}

$pathBack = '';

if ($counturlpath) {
    for ($countDiretoryBack = 0; $countDiretoryBack < $counturlpath; $countDiretoryBack++) {
        $pathBack = $pathBack . '../';
    }
}

define('REQUEST_PATH_BACK', $pathBack);

//Obtem via URL amigavel o valor do path (caso não sejá informado, é definido index/index como padrão)

$_GET['path'] = ((isset($_GET['path']) && !empty($_GET['path'])) ? $_GET['path'] : 'index/index');

//Separa o valor do controller do valor da action
$separatorPath = explode('/', $_GET['path']);

//Define o controller
$controller = ucfirst($separatorPath[0]) . 'Controller';

//Define a action (caso não sejá informado, é definido index como padrão)
$action = (isset($separatorPath[1]) ? $separatorPath[1] : 'index');
if ($action == '') $action = 'index';

//Verificação de Parametros
$_PARA = Array();
if (count($separatorPath) >= 3) {
    for ($separatorPathCount = 2; $separatorPathCount < count($separatorPath); $separatorPathCount++) {
        $_PARA[ $separatorPathCount - 2 ] = $separatorPath[ $separatorPathCount ];
    }
}

$controller = "App\\Controller\\" . $controller;
$application = new $controller;

//Debug::dump($_POST);
if (method_exists ( $application , $action)) {
    if (empty($_POST)) {
        if (count($_PARA) >= 1) {
            echo $application->$action($_PARA);
        } else {
            echo $application->$action();
        }
    } else {
        if (count($_PARA) >= 1) {
            echo $application->$action($_PARA, $_POST);
        } else {
            echo $application->$action($_POST);
        }
    }
} else {
    http_response_code(404);
    //include('my_404.php'); // provide your own HTML for the error page
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    die();
}