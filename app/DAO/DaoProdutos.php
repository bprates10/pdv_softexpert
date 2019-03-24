<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/03/2019
 * Time: 14:34
 */

namespace DAO;

use \Helpers\Conexao;
use Models\Produtos;

class DaoProdutos extends BaseDAO
{

    /* Consulta dos produtos cadastrados
     * Pode receber um Integer com o ID do produto específico
     * Retorna um array de Produtos
     */
    public function getListagem($id = "") {

        $con = $this->getConexao();
        $con->connect();
        $where = "";

        if ($id != "") {
            $where = " where id = $id";
        }
        $sql = "select * from produtos" . $where;

        $result = $con->query($sql);
        $arrProdutos = [];

        if ($result) {
            while ($prod = pg_fetch_assoc($result)) {
                $produto = new Produtos();
                $produto->setId($prod['id']);
                $produto->setDescricao($prod['descricao']);
                $produto->setPreco($prod['preco']);
                $produto->setIdCategoria($prod['id_categoria']);
                $arrProdutos[] = $produto;
            }
        }
        return $arrProdutos;
    }

    /* Consulta o total de $params cadastrados na tabela de Produtos
     * Recebe uma String com o parâmetro Column a ser totalizado
     * Retorna um inteiro
     */
    public function getContagemTotal($param = "*") {

        $con = $this->getConexao();
        $con->connect();

        if ($param == "*") {
            $sql = "select count($param) as cnt from produtos";
        } else {
            $sql = "select count(distinct $param) as cnt from produtos";
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

    /* Consulta o total de produtos sem cagegoria
     * Pode receber um Integer com o ID do produto (não utilizado)
     * Retorna um Integer com o total de produtos sem categoria
     */
    public function getProdutosSemCategoria($id = "") {

        $con = $this->getConexao();
        $con->connect();

        if ($id != "") {
            //$sql = "select count($param) as cnt from produtos";
        } else {
            $sql = "select count(*) as cnt from produtos where id_categoria is null";
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

    /* Consulta a média de produtos por cagegoria
     * Retorna um Integer com a média de produtos / categoria
     */
    public function getMediaProdutosPorCategoria() {
        $con = $this->getConexao();
        $con->connect();

        $sql = "select
                  case
                    when count(distinct id) > 0 or count(distinct id_categoria) > 0 then count(distinct id) / count(distinct id_categoria)
                    else 0
                  end as cnt
                from produtos;";

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