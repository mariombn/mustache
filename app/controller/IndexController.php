<?php

class IndexController
{
    public function index() {
        try {
            $simple = new Simple();
            $view = new View('index/index');
            $view->__set("simple", $simple->simple());
            $view->carregar();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}