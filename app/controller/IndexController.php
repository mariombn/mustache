<?php

class IndexController
{
    public function index() {
        try {
            $view = new View('index/index');
            $view->carregar();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}