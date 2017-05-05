<?php

namespace Mustache;

/**
 * Classe para controlar tudo relacionado a view do MVC
 *
 * @author Mario de Moraes <mariombn@gmail.com>
 *
 */
class View
{

    /**
     * Nome da view
     * @var String
     */
    private $name;

    /**
     * Titulo da view
     * @var String
     */
    private $title = APP_NAME;

    /**
     * Mensagem de Copyright da view
     * @var String
     */
    private $copy = APP_COPYRIGHT;

    /**
     * Valores dinamicos que são passados para a view
     * @var array
     */
    private $vars = array();

    /**
     * Valores dinamicos que são passados para a view
     * @var String
     */
    private $errorMsg = null;

    /**
     * Construtor padrão.
     * @param String $view
     * @return void
     */
    public function __construct($view = 'index/index')
    {
        $this->name = $view;
    }

    /**
     * Carrega o(s) arquivo(s) da view
     *        special = true  -> carrega apenas a view
     *        special = false -> carrega a view e os includes de header, menu e footer
     * @param boolean $special
     * @return void
     */
    public function carregar($special = false)
    {
        if (!$special) {
            //include APPPATH . '/public/includes/header.php';
            //include APPPATH . '/includes/menu.php';
            include APPPATH . '/public/view/' . $this->name . '.php';
            //include APPPATH . '/public/includes/footer.php';
        } else {
            include APPPATH . '/public/view/' . $this->name . '.php';
        }
    }

    /**
     * Define um valor de transporte para a view
     * @param String $index , String $value
     * @return void
     */
    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    /**
     * Retorna um valor de transporte da view
     * @param String $index
     * @return String $value
     */
    public function __get($index)
    {
        return $this->vars[$index];
    }

    /**
     * Usa como base a definição REQUEST_PATH_BACK para re-escrever um link de redirecionamento
     * @param String $data
     * @return String $dataFormatada
     */
    private function link($caminho)
    {
        echo HOME_PATH . $caminho;
    }
}
