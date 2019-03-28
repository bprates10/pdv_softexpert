<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/03/2019
 * Time: 22:26
 */

namespace DAO;


class DaoVendasItem extends BaseDAO
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

    public function addItemVenda($id_item,$valor_total_item,$id_venda,$id_imposto,$valor_total_imposto = 0,$qtde_item = 0) {
        $con = $this->getConexao();
        $con->connect();

        $sql = "insert into vendas_item (id_item,valor_item,id_venda,id_imposto,valor_imposto,quantidade) ";
        $sql.= "values ($id_item,$valor_total_item,$id_venda,$id_imposto,$valor_total_imposto,$qtde_item)";

        $con->query($sql);

        // retorna o id da venda_item
        $sql = "select max(id) as cnt from vendas_item";
        $res = $con->query($sql);
        $idVendasItem = 0;
        if ($res) {
            while ($result = pg_fetch_assoc($res)) {
                $idVendasItem = $result['cnt'];
            }
        }
        return $idVendasItem;
    }

    public function getTotalParcialNF($id_venda) {
        $con = $this->getConexao();
        $con->connect();

        $sql = "select sum(valor_item) as total from vendas_item where id_venda = $id_venda";
        $res = $con->query($sql);
        $total = 0;
        if ($res) {
            while ($result = pg_fetch_assoc($res)) {
                $total = $result['total'];
            }
        }
        return $total;
    }
}