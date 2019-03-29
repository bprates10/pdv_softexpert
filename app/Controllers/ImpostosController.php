<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 24/03/2019
 * Time: 19:54
 */

namespace Controllers;

use DAO\DaoImpostos;

include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "bootstrap.php";

class ImpostosController
{
    public function cadastrar($params = []) {

        $descricao  = $params['inf1'] ? $params['inf1'] : '';
        $percentual = $params['inf2'] ? $params['inf2'] : '';

        $dao = new DaoImpostos();
        $dao->cadastrar($descricao, $percentual);
    }
}