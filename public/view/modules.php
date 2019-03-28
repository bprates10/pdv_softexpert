<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 24/03/2019
 * Time: 19:32
 */

var_dump($_POST);

if (isset($_POST) && !empty($_POST)) {

    $modulo = $_POST['modulo'];
    $acao   = $_POST['acao'];

    switch ($modulo) {
        case "Produtos":
            break;
        case "Categorias":
            break;
        case "Impostos":

    }



    switch ($acao) {

    }


}

unset($_POST);