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
                $_SESSION['info_views']['call']                             = "Produtos";
                $_SESSION['info_views']['id_view']                          = "tela_produtos";
                $_SESSION['info_views']['title']                            = "Produtos";
                $_SESSION['info_views']['cards']['card_1']                  = "Total Cadastrado:";
                $_SESSION['info_views']['cards']['card_2']                  = "Produtos Sem Categoria:";
                $_SESSION['info_views']['cards']['card_3']['desc']          = "Nome Produto:";
                $_SESSION['info_views']['cards']['card_3']['percentual']    = "50% das vendas";
                $_SESSION['info_views']['input']['input1']                  = "Código do Produto :";
                $_SESSION['info_views']['input']['input2']                  = "Descrição :";
                $_SESSION['info_views']['input']['input3']                  = "Categoria :";

                require_once ('view/cadastros/frame_generico.php');
                unset($_SESSION['info_views']);
                break;

            case 'cadastroCategorias':
                $_SESSION['info_views']['call']                             = "Categorias";
                $_SESSION['info_views']['id_view']                          = "tela_categorias";
                $_SESSION['info_views']['title']                            = "Categorias";
                $_SESSION['info_views']['cards']['card_1']                  = "Total Cadastrado:";
                $_SESSION['info_views']['cards']['card_2']                  = "Média de Produtos por Categoria:";
                $_SESSION['info_views']['cards']['card_3']['desc']          = "Categoria:";
                $_SESSION['info_views']['cards']['card_3']['percentual']    = "81% das vendas";
                $_SESSION['info_views']['input']['input1']                  = "Código da Categoria :";
                $_SESSION['info_views']['input']['input2']                  = "Descrição :";

                require_once ('view/cadastros/frame_generico.php');
                unset($_SESSION['info_views']);
                break;

            case 'cadastroImpostos':
                $_SESSION['info_views']['call']                             = "Impostos";
                $_SESSION['info_views']['id_view']                          = "tela_impostos";
                $_SESSION['info_views']['title']                            = "Impostos";
                $_SESSION['info_views']['cards']['card_1']                  = "Total Cadastrado:";
                $_SESSION['info_views']['cards']['card_2']                  = "Categorias Sem Imposto";
                $_SESSION['info_views']['cards']['card_3']['desc']          = "Valor Imposto / Total NF";
                $_SESSION['info_views']['cards']['card_3']['percentual']    = "11% das vendas";
                $_SESSION['info_views']['input']['input1']                  = "Código do Imposto :";
                $_SESSION['info_views']['input']['input2']                  = "Descrição :";
                $_SESSION['info_views']['input']['input3']                  = "Percentual % :";

                require_once ('view/cadastros/frame_generico.php');
                unset($_SESSION['info_views']);
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