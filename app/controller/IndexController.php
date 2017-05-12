<?php

namespace App\Controller;

use App\Model\User;
use Mustache\Controller;
use Mustache\Debug;
use Mustache\View;
use App\Model\Simple;

class IndexController extends Controller
{
    public function index()
    {
        try {

            $view = new View('index.index');
            $view->show();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function teste()
    {
        echo $_SERVER['HTTP_HOST'];

    }
}