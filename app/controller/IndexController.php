<?php

namespace App\Controller;

use Mustache\Controller;
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
}