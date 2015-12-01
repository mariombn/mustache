<?php

class indexController
{
    public function index() {
        $banco = new database();
        $banco->teste();
    }
}