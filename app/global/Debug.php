<?php

/**
 * Class Debug
 * Classe Responsavel por tratamento de debug e depuração da Aplicação em tempo de Construção.
 */
class Debug
{
    /**
     * Imprime da Tela um erro no formato do print_r apenas com o debug da aplicação ligado
     * @param $buffer
     */
    public static function dump($buffer)
    {
        if (DEBUG) {
            echo '<br/>--------------------<pre>';
            print_r($buffer);
            echo '</pre>--------------------<br/>';
        }
    }

    /**
     * Imprime um buffer no console do Navegador apenas quando o debug da aplicação estiver ligado
     * @param $buffer
     */
    public static function console($buffer)
    {
        if (DEBUG) {
            echo "<script>console.log('" . $buffer . "');</script>";
        }
    }
}