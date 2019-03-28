<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/03/2019
 * Time: 22:22
 */

namespace Controllers;

include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "bootstrap.php";

if (isset($_POST['acao']) && $_POST['acao'] == 'xxxxxxxxxxxxx') {

    $controller = new Ve();
    //$controller->cadastrar($_POST);
    return true;
}

class VendasController
{
    public function cadastrar($params = []) {

        $codigo       = $params['inf1'] ? $params['inf1'] : '';
        $descricao    = $params['inf2'] ? $params['inf2'] : '';
        $id_categoria = $params['inf3'] ? $params['inf3'] : '';
        $valor        = $params['inf4'] ? $params['inf4'] : '';

        $dao = new DaoProdutos();
        $dao->cadastrar($codigo, $descricao, $id_categoria, $valor);
    }
}