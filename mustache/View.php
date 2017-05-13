<?php

namespace Mustache;

class View
{
    private $view;
    private $atributes = array();
    private $load = false;

    public function __construct($view)
    {
        $this->view = str_replace('.', '/', $view);
    }

    public function show($head = true)
    {
        if ($head) include_once APPPATH . '/resource/layouts/header.php';
        include_once APPPATH . '/resource/view/' . $this->view . '.php';
        if ($head) include_once APPPATH . '/resource/layouts/footer.php';
        $this->load = true;
    }

    public static function lang($label)
    {
        echo Language::getLabel($label);
    }

    public static function link($path, $label, $atributes = '')
    {
        echo "<a href='" . HOME_PATH . "$path' $atributes >$label</a>";
    }

    public static function assets($path, $subdir = false)
    {
        if (!$subdir) {
            echo HOME_PATH . 'assets/' . $path;
        } else {
            echo HOME_PATH . 'assets/' . $subdir . '/' . $path;
        }
    }

    public function post($k, $v)
    {
        $this->atributes[$k] = $v;
    }

    public function get($k)
    {
        return $this->atributes[$k];
    }
}