<?php

/**
 * Class Valida
 * Classe responsavel por toda a validaчуo de dados da Aplicaчуo
 */
class Valida
{
    /**
     * Metodo responsavel por validar e-mail
     * @param String $email
     * @return bool
     */
    public static function email($email)
    {
        if (empty ($email) || !preg_match("/^[_a-zA-Z0-9-]+((\.|_*)[a-zA-Z0-9-]+)*@[_a-zA-Z0-9\-]+((\.|_*)[a-zA-Z0-9-]+)*\.([a-zA-Z]{3,4}|(([a-zA-Z]{3}\.){0,1}[a-zA-Z]{2}))$/", $email)) {
            return false;
        } else {
            return true;
        }
    }
}