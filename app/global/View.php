<?php
/**
 * Classe para controlar tudo relacionado a view do MVC
 *
 * @author Mario de Moraes <mariombn@gmail.com>
 *
 */
class View {

    /**
     * Nome da View
     * @var String
     */
    private $name;

    /**
     * Titulo da View
     * @var String
     */
    private $title = APP_NAME;

    /**
     * Mensagem de Copyright da View
     * @var String
     */
    private $copy  = APP_COPYRIGHT;

    /**
     * Valores dinamicos que são passados para a View
     * @var array
     */
    private $vars  = array();

    /**
     * Valores dinamicos que são passados para a View
     * @var String
     */
    private $errorMsg = null;

    /**
     * Construtor padrão.
     * @param String $view
     * @return void
     */
    public function __construct($view = 'index/index') {
        $this->name = $view;
    }

    /**
     * Carrega o(s) arquivo(s) da View
     * 		special = true  -> carrega apenas a view
     * 		special = false -> carrega a view e os includes de header, menu e footer
     * @param boolean $special
     * @return void
     */
    public function carregar($special = false) {
        if(!$special) {
            //include APPPATH . '/includes/header.php';
            //include APPPATH . '/includes/menu.php';
            include APPPATH . '/public/app/view/' . $this->name . '.php';
            //include APPPATH . '/includes/footer.php';
        }
        else {
            include APPPATH . '/public/app/view/' . $this->name . '.php';
        }
    }

    /**
     * Retorna o camingo correto para ser carregado pela view em um link interno
     * @param String $destino
     * @return String $caminho
     */
    public function echoA($destino) {

    }

    /**
     * Define um valor de transporte para a View
     * @param String $index, String $value
     * @return void
     */
    public function __set($index, $value) {
        $this->vars[$index] = $value;
    }

    /**
     * Retorna um valor de transporte da View
     * @param String $index
     * @return String $value
     */
    public function __get($index) {
        return $this->vars[$index];
    }

    /**
     * Retorna a data no padrão brasileiro
     * @param String $data
     * @return String $dataFormatada
     */
    private function formatadata($data) {
        return date('d/m/Y',strtotime($data));
    }

    /**
     * Usa como base a definição REQUEST_PATH_BACK para re-escrever um link de redirecionamento
     * @param String $data
     * @return String $dataFormatada
     */
    private function link($caminho) {
        echo HOME_PATH . $caminho;
    }
}