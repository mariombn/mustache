<?php

namespace Mustache;

class Error
{
    public static function internal($errNumber, $errDescription)
    {

    }

    /**
     * @param $messenge
     */
    public static function display($messenge)
    {
        echo '<pre>';
        print_r($messenge);
        echo '</pre>';
    }
}