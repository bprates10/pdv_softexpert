<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 28/03/2019
 * Time: 21:08
 */

include_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "bootstrap.php";

use Controllers\CategoriasController;
use Controllers\ImpostosController;
use Controllers\ProdutosController;
use DAO\DaoProdutos;
use DAO\DaoCategorias;
use DAO\DaoImpostos;

//$objeto = $_SESSION['info_views']['call'];
$menus = ["ID", "Descrição"];
$arrList = [];

if (!empty($_POST)) {
    //var_dump($_POST['modulo']);
}

if (isset($_POST['modulo']) && $_POST['modulo'] == 'Produtos') {

    array_push($menus, "Preço");
    array_push($menus, "Categoria");

    if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {

        $controller = new ProdutosController();
        $controller->cadastrar($_POST);
        //return true;
    }

    $obj = new DaoProdutos();
    $arrList = $obj->getListagem();
}

if (isset($_POST['modulo']) && $_POST['modulo'] == 'Categorias') {

    array_push($menus, "ID Imposto");

    if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {

        $controller = new CategoriasController();
        $controller->cadastrar($_POST);
        //return true;
    }

    $obj = new \DAO\DaoCategorias();
    $arrList = $obj->getListagem();
}

if (isset($_POST['modulo']) && $_POST['modulo'] == 'Impostos') {

    array_push($menus, "Percentual (%)");

    if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {

        $controller = new ImpostosController();
        $controller->cadastrar($_POST);
        //return true;
    }

    $obj = new \DAO\DaoImpostos();
    $arrList = $obj->getListagem();
}

//var_dump($menus);
?>

<div class="content table-responsive table-full-width">
    <table id="grid" class="table table-hover table-striped" cellspacing="0" width="100%">
        <thead class="header">
        <th><?= $menus[0] ?></th>
        <th><?= $menus[1] ?></th>
        <?php if (isset($menus[2])) : ?>
            <th><?= $menus[2] ?></th>
        <?php endif; ?>
        <?php if (isset($menus[3])) : ?>
            <th><?= $menus[3] ?></th>
        <?php endif; ?>
        <th><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> </a> </th>
        </thead>
        <tbody>
        <?php
        foreach ($arrList as $item) : ?>
            <tr>
                <td> <?= $item->getId();            ?> </td>
                <td> <?= $item->getDescricao();     ?> </td>
                <?php if ($item instanceof \Models\Produtos) : ?>
                    <td> R$<?= $item->getPreco();       ?> </td>
                    <td> <?= $item->getIdCategoria();   ?> </td>
                <?php elseif ($item instanceof \Models\Categorias) : ?>
                    <td> <?= $item->getIdImposto();     ?> </td>
                <?php elseif ($item instanceof \Models\Impostos) : ?>
                    <td> <?= $item->getValor();     ?>% </td>
                <?php endif; ?>
                <td>
                    <i class="fa fa-edit" aria-hidden="true" onclick="alert('Método de edição não implementado (ainda!)')"></i>
                    <i class="fa fa-trash" aria-hidden="true" onclick="alert('Método de exclusão não implementado (ainda!)');"></i>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
