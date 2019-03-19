<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 18/03/2019
 * Time: 22:08
 */

namespace DAO;


use Models\Impostos;

class DaoImpostos extends BaseDAO
{
    /* Consulta dos impostos cadastrados
     * Pode receber um Integer com o ID do imposto específico
     * Retorna um array de Impostos
     */
    public function getListagem($id = "") {

        $con = $this->getConexao();
        $con->connect();
        $where = "";

        if ($id != "") {
            $where = " where id = $id";
        }
        $sql = "select * from impostos" . $where;

        $result = $con->query($sql);
        $arrImpostos = [];

        if ($result) {
            while ($imp = pg_fetch_assoc($result)) {
                $imposto = new Impostos();
                $imposto->setId($imp['id']);
                $imposto->setDescricao($imp['descricao']);
                $imposto->setValor($imp['valor']);
                $arrImpostos[] = $imposto;
            }
        }
        return $arrImpostos;
    }

    /* Consulta o total de $params cadastrados na tabela de Impostos
     * Recebe uma String com o parâmetro Column a ser totalizado
     * Retorna um inteiro
     */
    public function getContagemTotal($param = "*") {

        $con = $this->getConexao();
        $con->connect();

        if ($param == "*") {
            $sql = "select count($param) as cnt from impostos";
        } else {
            $sql = "select count(distinct $param) as cnt from impostos";
        }

        $result = $con->query($sql);
        $count = 0;

        if ($result) {
            while ($total = pg_fetch_assoc($result)) {
                $count = $total["cnt"];
            }
        }
        return $count;
    }
}