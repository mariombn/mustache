<?php

/**
 * Class Valida
 * Classe responsavel por toda a valida��o de dados da Aplica��o
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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }
}