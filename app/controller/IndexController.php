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

            $simple = new Simple();
            $simple->id = 1;
            $simple->name = 'Novo Nome';
            $simple->save();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}