<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/03/2019
 * Time: 17:38
 */

namespace DAO;

use \Helpers\Conexao;
use Models\Categorias;

class DaoCategorias extends BaseDAO
{
    /* Consulta das categorias cadastrados
     * Pode receber um Integer com o ID da categoria específica
     * Retorna um array de Categorias
     */
    public function getListagem($id = "") {

        $con = $this->getConexao();
        $con->connect();
        $where = "";

        if ($id != "") {
            $where = " where id = $id";
        }
        $sql = "select cat.id, cat.descricao,  imp.descricao as id_imposto
                from categorias cat
                inner join impostos imp on imp.id = cat.id_imposto" . $where;

        $result = $con->query($sql);
        $arrCategorias = [];

        if ($result) {
            while ($cat = pg_fetch_assoc($result)) {
                $categoria = new Categorias();
                $categoria->setId($cat['id']);
                $categoria->setDescricao($cat['descricao']);
                $categoria->setIdImposto($cat['id_imposto']);
                $arrCategorias[] = $categoria;
            }
        }
        return $arrCategorias;
    }

    /* Consulta o total de $params cadastrados na tabela de Caterorias
     * Recebe uma String com o parâmetro Column a ser totalizado
     * Retorna um inteiro
     */
    public function getContagemTotal($param = "*") {

        $con = $this->getConexao();
        $con->connect();

        if ($param == "*") {
            $sql = "select count($param) as cnt from categorias";
        } else {
            $sql = "select count(distinct $param) as cnt from categorias";
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

    /* Consulta o total de categorias sem imposto
     * Pode receber um Integer com o ID da categoria (não utilizado)
     * Retorna um Integer com o total de categorias sem imposto
     */
    public function getCategoriasSemImpostos($id = "") {

        $con = $this->getConexao();
        $con->connect();

        if ($id != "") {
            //$sql = "select count($param) as cnt from produtos";
        } else {
            $sql = "select count(*) as cnt from categorias where id_imposto is null";
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

    /* Cria um registro na tabela Categorias
     * Recebe uma String Código, uma String Descricao e uma String Id_Categoria
     * Não retorna valor
     */
    public function cadastrar($descricao = "Sem descrição", $id_categoria = "1") {

        $con = $this->getConexao();
        $con->connect();

        $sql = "insert into categorias (descricao, id_imposto) values ('$descricao', '$id_categoria')";

        $con->query($sql);
    }
}