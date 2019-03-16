<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 12/03/2019
 * Time: 22:37
 */

function routes($page) {

    try {
        switch ($page) {
            case 'cadastroProdutos':
                require_once ('view/cadastros/produto.php');
                break;
            case 'cadastroCategorias':
                require_once ('view/cadastros/categoria.php');
                break;
            case 'cadastroImpostos':
                require_once ('view/cadastros/imposto.php');
                break;
            case 'venda_pdv':
                require_once ('view/vendas/tela_vendas.php');
                break;
            case 'home_temporaria':
                require_once ('view/home_temp.php');
                break;
            default:
                require_once ('view/404.php');
                break;
        }
    } catch (Exception $e) {
        require_once ('view/404.php');
    }

}