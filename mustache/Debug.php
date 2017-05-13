<?php

namespace Mustache;

/**
 * Class Debug
 * Classe Responsavel por tratamento de debug e depura��o da Aplica��o em tempo de Constru��o.
 */
class Debug
{
    /**
     * Imprime da Tela um erro no formato do print_r apenas com o debug da aplica��o ligado
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
     * Imprime um buffer no console do Navegador apenas quando o debug da aplica��o estiver ligado
     * @param $buffer
     */
    public static function console($buffer)
    {
        if (DEBUG) {
            echo "<script>console.log('" . $buffer . "');</script>";
        }
    }
}