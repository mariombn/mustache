<?php

class Usuario
{
    private $usua_id;
    private $usua_login;
    private $usua_email;
    private $usua_nome;
    private $usua_sobrenome;
    private $usua_data_cad;
    private $usua_data_upd;
    private $usua_status;

    /**
     * Metodo get
     * @return Usuario
     */
    public function get_usua_id() { return $this-usua_id; }
    public function get_usua_login() { return $this->usua_login; }
    public function get_usua_email() { return $this->usua_email; }
    public function get_usua_nome() { return $this->usua_nome; }
    public function get_usua_sobrenome() { return $this->usua_sobrenome; }
    public function get_usua_data_cad() { return $this->usua_data_cad; }
    public function get_usua_data_upd() { return $this->usua_data_upd; }
    public function get_usua_status() { return $this->usua_status; }

    /**
     * @param $mix
     */
    public function set_usua_id($usua_id) { $this->usua_id = $usua_id; }
    public function set_usua_login($usua_login) { $this->usua_login = $usua_login; }
    public function set_usua_email($usua_email) { $this->usua_email = $usua_email; }
    public function set_usua_nome($usua_nome) { $this->usua_nome = $usua_nome; }
    public function set_usua_sobrenome($usua_sobrenome) { $this->usua_sobrenome = $usua_sobrenome; }
    public function set_usua_data_cad($usua_data_cad) { $this->usua_data_cad = $usua_data_cad; }
    public function set_usua_data_upd($usua_data_upd) { $this->usua_data_upd = $usua_data_upd; }
    public function set_usua_status($usua_status) { $this->usua_status = $usua_status; }
}