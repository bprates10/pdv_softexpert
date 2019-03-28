<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/03/2019
 * Time: 22:28
 */

namespace Controllers;

use DAO\DaoCategorias;
use DAO\DaoImpostos;
use DAO\DaoProdutos;
use DAO\DaoVendasItem;

include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "bootstrap.php";

if (isset($_POST['acao'])) {
    $controller = new VendasItemController();

    if ($_POST['acao'] == 'calcula_total_item') {
        echo json_encode($controller->totalizaItem($_POST));
    }
    if ($_POST['acao'] == "adiciona_item_nf") {
        echo $controller->adicionaItemNF($_POST);
    }
}

class VendasItemController
{
    public function totalizaItem($params = []) {

        $qtde         = $params['qtde'];
        $id_item      = $params['item'];

        $dao          = new DaoProdutos();
        $objProduto   = $dao->getListagem($id_item);
        $precoProduto = $objProduto[0]->getPreco(); // 2.5

        $subtotal     = (int)$qtde * (float)$precoProduto; // 2.5

        $dao          = new DaoCategorias();
        $objCategoria = $dao->getListagem($objProduto[0]->getIdCategoria());

        $dao = new DaoImpostos();
        $objImposto   = $dao->getListagem($objCategoria[0]->getIdImposto());
        $percentImp   = $objImposto[0]->getValor(); // 15

        $valorImposto = ($percentImp / 100) * ($precoProduto * $qtde);
        $totalSemImposto = ($precoProduto * $qtde) - $valorImposto;

        $totalizador = [
            "subtotal"  => $subtotal,
            "imposto"   => $valorImposto,
            "liquido"   => $totalSemImposto
        ];
        return $totalizador;
    }

    public function adicionaItemNF($params = []) {

        $id_venda            = $params['idVenda'];
        $qtde_item           = $params['qtde'];
        $id_item             = $params['item'];
        $valor_total_item    = $params['vlrTotal'];
        $valor_total_imposto = $params['vlrImposto'];

        $dao = new DaoProdutos();
        $produto = $dao->getListagem($id_item);
        $idCategoria = $produto[0]->getIdCategoria();

        $daoImp = new DaoImpostos();
        $imposto = $daoImp->getListagem($idCategoria);
        $idImposto = $imposto[0]->getId();

        $dao = new DaoVendasItem();
        $id_venda_item = $dao->addItemVenda($id_item,$valor_total_item,$id_venda,$idImposto,$valor_total_imposto,$qtde_item);

        $daoImp->addImpostoVenda($id_venda_item,$idImposto,$valor_total_imposto);

        return $dao->getTotalParcialNF($id_venda);


    }
}