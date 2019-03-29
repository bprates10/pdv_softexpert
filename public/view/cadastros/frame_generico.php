<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/03/2019
 * Time: 13:20
 */

include_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "bootstrap.php";

use DAO\DaoProdutos;
use Models\Produtos;

$id_div = $_SESSION['info_views']['id_view'];
$titulo = $_SESSION['info_views']['title'];
$card1  = $_SESSION['info_views']['cards']['card_1'];
$card2  = $_SESSION['info_views']['cards']['card_2'];
$card3  = $_SESSION['info_views']['cards']['card_3'];
$input1 = $_SESSION['info_views']['input']['input1'];
$input2 = isset($_SESSION['info_views']['input']['input2']) ? $_SESSION['info_views']['input']['input2'] : "";
$input3 = isset($_SESSION['info_views']['input']['input3']) ? $_SESSION['info_views']['input']['input3'] : "";

$objeto = $_SESSION['info_views']['call'];

if ($objeto == "Produtos") {

    $input4  = "Preço (R$)";

    $obj = new DaoProdutos();
    $value1  = $obj->getContagemTotal();
    $value2  = $obj->getProdutosSemCategoria();

    $obj = new \DAO\DaoCategorias();
    $value3  = $obj->getListagem();
}
if ($objeto == "Categorias") {
    //array_push($menus, "ID Imposto");

    $obj = new \DAO\DaoCategorias();
    //$arrList = $obj->getListagem();
    $value1  = $obj->getContagemTotal();

    $obj     = new DaoProdutos();
    $value2  = $obj->getMediaProdutosPorCategoria();

    $obj     = new \DAO\DaoImpostos();
    $value3  = $obj->getListagem();

}
if ($objeto == "Impostos") {
    //array_push($menus, "Percentual (%)");

    $obj = new \DAO\DaoImpostos();
    //$arrList = $obj->getListagem();
    $value1  = $obj->getContagemTotal();
    $obj     = new \DAO\DaoCategorias();
    $value2  = $obj->getCategoriasSemImpostos();
}
?>

<div class="container-fluid" id="<?= $id_div ?>">
    <!-- Título da View -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $titulo ?></h1>
    </div>

    <!-- Cards -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $card1 ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $value1 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?= $card2 ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $value2 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?= $card3['desc'] ?></div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $card3['percentual'] ?></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Cards -->

    <!-- Campos de Input e Buttons -->
    <div class="row">
        <!-- Inputs -->
        <div class="col-xl-8 col-lg-8">

            <!-- Input 1 -->
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1"><?= $input1 ?></div>
                <input type="text" id="input_1" onblur="habilitaBotaoCadastrar()">
            </div>

            <!-- Input 2 -->
            <?php if ($objeto != "Categorias") : ?>
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1"><?= $input2 ?></div>
                <?php
                $tipo = "text";
                $limit = "";
                if ($objeto == "Impostos") {
                    $tipo = "number";
                    $limit = 'onkeyup="limitarInput(this)"';
                }
                ?>
                <input type="<?= $tipo ?>" id="input_2" <?= $limit ?> onblur="habilitaBotaoCadastrar()">
            </div>
            <?php endif; ?>

            <!-- Input 3 -->
            <?php if (isset($input3) && !empty($input3)) : ?>
            <div class="card shadow mb-4">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1"><?= $input3 ?></div>
                <?php if (!empty($objeto) && $objeto != "Impostos") : ?>
                    <select id="input_3" class="custom-select" onblur="habilitaBotaoCadastrar()">
                        <?php if (!empty($value3)) :
                            foreach ($value3 as $item) :
                                if ($objeto == "Categorias") :
                                    $var = $item->getValor() . "%" . " - " . $item->getDescricao();
                                else :
                                    $var = $item->getDescricao();
                                endif; ?>
                        <option value="<?= $item->getId() ?>"><?= $var ?></option>
                        <?php endforeach; else : ?>
                        <option value="" selected disabled>Não existem <?= $objeto ?> cadastrados !</option>
                        <?php endif; ?>
                    </select>
                <?php else : ?>
                <input type="text" id="input_3" onblur="habilitaBotaoCadastrar()">
                <?php endif; ?>
            </div>
            <?php else : ?>
                <input type="text" id="input_3" value="imposto" hidden>
            <?php endif; ?>

            <!-- Input 4 -->
            <?php if ($objeto == "Produtos" && (isset($input4) && !empty($input3)) ) : ?>
                <div class="card shadow mb-4">
                    <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1"><?= $input4 ?></div>
                    <input type="text" maxlength="7" onkeyup="return(formataMoeda(this,'.',',',event))" id="input_4">
                </div>
            <?php endif; ?>

        </div>
        <!-- Fim Campos -->

        <!-- Buttons -->
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-5">
                <input type="button" id="btnCadastrar" value="CADASTRAR" class="btn btn-success" onclick="cadastrar('<?=$objeto?>')" disabled>
            </div>
            <div class="card shadow mb-5">
                <input type="button" value="LIMPAR" class="btn btn-danger" onclick="limparCampos('<?=$objeto?>')">
            </div>
            <div class="card shadow mb-5">
                <input type="button" value="PESQUISAR" class="btn btn-info" onclick="getGridItens('<?=$objeto?>')">
            </div>
        </div>
    </div>
    <!-- Fim Campos de Entrada -->

    <div class="row" id="div_grid">

    </div>
</div>

<script>

    function limitarInput(obj) {
        var valor = obj.value.substring(0,3);
        if (valor > 100) {
            obj.value = obj.value.substring(0,2);
        }
        else {
            obj.value = obj.value.substring(0,3);
        }
    }

    function formataMoeda(a, e, r, t) {

        let n = ""
            , h = j = 0
            , u = tamanho2 = 0
            , l = ajd2 = ""
            , o = window.Event ? t.which : t.keyCode;
        if (13 == o || 8 == o)
            return !0;
        /*
        if (n = String.fromCharCode(o),
        -1 == "0123456789".indexOf(n))
            return !1;
         */
        for (u = a.value.length,
                 h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
            ;
        for (l = ""; h < u; h++)
            -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
        if (l += n,
        0 == (u = l.length) && (a.value = ""),
        1 == u && (a.value = "0" + r + "0" + l),
        2 == u && (a.value = "0" + r + l),
        u > 2) {
            for (ajd2 = "",
                     j = 0,
                     h = u - 3; h >= 0; h--)
                3 == j && (ajd2 += e,
                    j = 0),
                    ajd2 += l.charAt(h),
                    j++;
            for (a.value = "",
                     tamanho2 = ajd2.length,
                     h = tamanho2 - 1; h >= 0; h--)
                a.value += ajd2.charAt(h);
            a.value += r + l.substr(u - 2, u)
        }
        return !1
    }

    function habilitaBotaoCadastrar() {
        var input1 = $('#input_1').val();
        var input2 = $('#input_2').val();
        var input3 = $('#input_3').val();

        if ( input1 != "" && input2 != "" && ( input3 != null && input3 != "" ) ) {
            $('#btnCadastrar').removeAttr('disabled');
        } else {
            $('#btnCadastrar').attr('disabled', 'disabled');
        }
    };

    function limparCampos(obj) {
        $('#input_1').val("");
        $('#input_2').val("");
        $('#input_3').val("");
        if (obj == "Produtos") {
            $('#input_4').val("");
        }
    }

    function cadastrar(objeto) {

        var input1 = $('#input_1').val() ? $('#input_1').val() : "";
        var input2 = $('#input_2').val() ? $('#input_2').val() : "";
        var input3 = $('#input_3').val() ? $('#input_3').val() : "";
        var input4 = "";

        var modulo = objeto;
        var acao   = 'cadastrar';

        if (modulo == "Produtos") {
            input4 = $('#input_4').val() ? $('#input_4').val() : "";
            //var url = "../app/Controllers/ProdutosController.php";
            var url = "view/cadastros/grid_generica.php";
        }
        if (modulo == "Impostos") {
            //var url = "../app/Controllers/ImpostosController.php";
            var url = "view/cadastros/grid_generica.php";
        }
        if (modulo == "Categorias") {
            //var url = "../app/Controllers/CategoriasController.php";
            var url = "view/cadastros/grid_generica.php";
        }

        $.ajax({
            "url" : url,
            "type": 'POST',
            "dataType": 'html',
            "data": {
                acao   : acao,
                modulo : modulo,
                inf1   : input1,
                inf2   : input2,
                inf3   : input3,
                inf4   : input4
            }
        }).done(function (resp) {
            alert(objeto + ' ' + input1 + ' cadastrado com sucesso.');
            limparCampos();
            $("#div_grid").html(resp);
        }).fail(function (resp) {
            console.log('Erro ! Contate o desenvolvedor !');
        });
    }

    function getGridItens(objeto) {

        var modulo = objeto;
        var acao   = 'visualizar';

        if (modulo == "Produtos") {
            var url = "view/cadastros/grid_generica.php";
        }
        if (modulo == "Impostos") {
            var url = "view/cadastros/grid_generica.php";
        }
        if (modulo == "Categorias") {
            var url = "view/cadastros/grid_generica.php";
        }

        $.ajax({
            "url" : url,
            "type": 'POST',
            "dataType": 'html',
            "data": {
                acao   : acao,
                modulo : modulo
            }
        }).done(function (resp) {
            console.log(resp);
            alert("Atualizado");
            $("#div_grid").html(resp);
        }).fail(function (resp) {
            console.log('Erro ! Contate o desenvolvedor !');
        });
    }

</script>