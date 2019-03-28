<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/03/2019
 * Time: 20:37
 */

include_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "bootstrap.php";

//$venda = new \DAO\DaoImpostos();

$daoProduto = new \DAO\DaoProdutos();
$arrProdutos = $daoProduto->getListagem();

$oVenda = new \Models\Vendas();
$idVenda= $oVenda->getId();
?>

<div class="container-fluid" id="<?= $id_div ?>">
    <!-- Título da View -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h1 mb-0 text-gray-800">Tela de Vendas</h1>
    </div>

    <!-- Campos de Input e Buttons -->
    <div class="row">
        <!-- Select Produto -->
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1">Código do Produto</div>
                <select id="select" onblur="habilitaQuantidade()">
                    <option value="">Selecione</option>
                    <?php if (!empty($arrProdutos)) :
                    foreach ($arrProdutos as $prod) : ?>
                    <option value="<?= $prod->getId() ?>"><?= $prod->getDescricao() ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>
        </div>
        <!-- Input Quantidade -->
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1">Quantidade</div>
                <input type="number" id="quantidade" onblur="calculaSubTotal()" disabled>
            </div>
        </div>
        <!-- Botão Adicionar -->
        <div class="col-xl-2 col-lg-2">
            <div>
                <input type="button" id="btnCadastrar" value="ADICIONAR" class="btn btn-info" onclick="adicionaItem(<?=$idVenda ?>)" disabled>
            </div>
        </div>
    </div>
    <!-- Campos de Totalizadores -->
    <div class="row">
        <!-- Input Sub Total Itens -->
        <div class="col-xl-3 col-lg-3">
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1">Sub-Total (R$)</div>
                <input type="text" id="subtotal" disabled>
            </div>
        </div>
        <!-- Input Total Impostos -->
        <div class="col-xl-3 col-lg-3">
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1">Imposto da Nota (R$)</div>
                <input type="text" id="totalimpostos" disabled>
            </div>
        </div>
        <!-- Input Total Sem Impostos -->
        <div class="col-xl-3 col-lg-3">
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1">Total Sem Impostos (R$)</div>
                <input type="text" id="totalsemimpostos" disabled>
            </div>
        </div>
        <!-- Input Total Itens -->
        <div class="col-xl-3 col-lg-3">
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1">Total (R$)</div>
                <input type="text" id="total" disabled>
            </div>
        </div>
        <!-- Fim Campos -->
    </div>
    <!-- Buttons -->
    <div class="row">
        <div class="col-xl-2 col-lg-2">
            <input type="button" id="btnVender" value="FINALIZAR" class="btn btn-success" onclick="limparCampos()" disabled>
        </div>
        <div class="col-xl-2 col-lg-2">
            <input type="button" value="LIMPAR" class="btn btn-danger" onclick="limparCampos()">
        </div>
    </div>

    <div class="row">
        <?php include_once "grid_itens.php"; ?>
    </div>
</div>

<script>
    function limparCampos() {
        $('#select').val("");
        $('#input_1').val("");
        $('#total_item').val("");
        $('#subtotal').val("");
        $('#totalimpostos').val("");
        $('#totalsemimpostos').val("");
        $('#btnCadastrar').attr('disabled', 'disabled');
    }

    function habilitaQuantidade() {
        if ($('#select').val()) {
            $('#quantidade').removeAttr('disabled');
        } else {
            $('#quantidade').val("");
            $('#quantidade').attr('disabled', 'disabled');
        }
    }

    function calculaSubTotal() {
        var qtde = $('#quantidade').val();
        var item = $('#select').val();

        if (qtde != "" && item != "") {

            $.ajax({
                "url" : '../app/Controllers/VendasItemController.php',
                "type": 'POST',
                "dataTipe": 'json',
                "data": {
                    acao : 'calcula_total_item',
                    qtde : qtde,
                    item : item
                }
            }).done(function (valor) {
                var valor = JSON.parse(valor);
                //console.log(valor);
                $('#subtotal').val(valor.subtotal);
                $('#totalimpostos').val(valor.imposto);
                $('#totalsemimpostos').val(valor.liquido);

                $('#btnCadastrar').removeAttr('disabled');
            }).fail(function (resp) {
                alert('Erro !');
            });
        }
    }

    function adicionaItem( idVenda) {
        var qtde     = $('#quantidade').val();
        var item     = $('#select').val();
        var total    = $('#subtotal').val();
        var totalImp = $('#totalimpostos').val();

        console.log(qtde,totalImp,total,item,idVenda);

        if (qtde != "" && totalImp != "" && total != "" && item != "") {
            $.ajax({
                "url" : '../app/Controllers/VendasItemController.php',
                "type": 'POST',
                "dataTipe": 'json',
                "data": {
                    acao       : 'adiciona_item_nf',
                    idVenda    : idVenda,
                    qtde       : qtde,
                    item       : item,
                    vlrTotal   : total,
                    vlrImposto : totalImp
                }
            }).done(function (resp) {
                alert('Item adicionado com sucesso !');
                $('#total').val(resp);
                /*
                var valor = JSON.parse(valor);

                $('#subtotal').val(valor.subtotal);
                $('#totalimpostos').val(valor.imposto);
                $('#totalsemimpostos').val(valor.liquido);

                $('#btnCadastrar').removeAttr('disabled');

                //atualizaGridItens(idVenda, valor, qtde, item);*/
            }).fail(function (resp) {
                //console.log(resp);
            });
        }
        else {
            alert('Campo obrigatório não preenchido !');
        }
    }

    function atualizaGridItens() {

        console.log(valor, qtde, item);
/*
        $.ajax({
            "url" : 'grid_itens.php',
            "type": 'POST',
            "data": {
                acao : 'adiciona_item_grid',
                item : item,
                qtde : qtde,
                subt : valor.subtotal,
                vimp : valor.imposto,
                vliq : valor.liquido
            }
        }).done(function (resp) {
            alert(resp);
        }).fail(function (resp) {
            alert(resp);
        });*/
    }

</script>