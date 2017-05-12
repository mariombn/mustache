<?php

namespace App\Controller;

use Mustache\Controller;

class ConsoleController extends Controller
{
    public function index()
    {
        try {

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}