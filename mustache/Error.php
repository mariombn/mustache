<?php

namespace Mustache;

class Error
{
    public static function internal($errNumber, $errDescription)
    {

    }

    /**
     * Display an error with print_r
     * @param $messenge
     * @param bool $cli
     */
    public static function display($messenge, $cli = false)
    {
        if (!$cli) echo '<pre>';
        print_r($messenge);
        if (!$cli) echo '</pre>';
    }
}