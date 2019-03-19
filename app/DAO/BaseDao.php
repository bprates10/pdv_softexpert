<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/03/2019
 * Time: 14:42
 */

namespace DAO;

abstract class BaseDAO
{
    protected function getConexao() {
        $con = \Helpers\Registry::getValue("Conexao", null);

        if ($con == null)
        {
            $con = new \Helpers\Conexao([
                "host"=>'localhost',
                "port"=>'5432',
                "base"=>'pdv_softexpert',
                "user"=>'postgres',
                "pass"=>'10'
            ]);
            \Helpers\Registry::setValue("Conexao", $con);
        }
        return $con;
    }
}