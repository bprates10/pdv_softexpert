<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 24/03/2019
 * Time: 20:53
 */

namespace Controllers;

use DAO\DaoCategorias;

include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "bootstrap.php";

class CategoriasController
{
    public function cadastrar($params = []) {

        //$codigo       = $params['inf1'] ? $params['inf1'] : '';
        $descricao    = $params['inf1'] ? $params['inf1'] : '';
        $id_categoria = $params['inf3'] ? $params['inf3'] : '';

        $dao = new DaoCategorias();
        $dao->cadastrar($descricao, $id_categoria);
    }
}