<?php

namespace App\Controller;

use Mustache\Controller;
use Mustache\View;

class IndexController extends Controller
{
    public function index()
    {
        try {
            echo "Ola Mundo";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}