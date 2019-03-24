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
$input2 = $_SESSION['info_views']['input']['input2'];
$input3 = isset($_SESSION['info_views']['input']['input3']) ? $_SESSION['info_views']['input']['input3'] : "";

$objeto = $_SESSION['info_views']['call'];
$menus = ["ID", "Descrição"];

if ($objeto == "Produtos") {
    array_push($menus, "Preço");
    array_push($menus, "Categoria");

    $obj = new DaoProdutos();
    $arrList = $obj->getListagem();
    $value1  = $obj->getContagemTotal();
    $value2  = $obj->getProdutosSemCategoria();

    $obj = new \DAO\DaoCategorias();
    $value3  = $obj->getListagem();
}

if ($objeto == "Categorias") {
    array_push($menus, "ID Imposto");

    $obj = new \DAO\DaoCategorias();
    $arrList = $obj->getListagem();
    $value1  = $obj->getContagemTotal();

    $obj     = new DaoProdutos();
    $value2  = $obj->getMediaProdutosPorCategoria();

    $obj     = new \DAO\DaoImpostos();
    $value3  = $obj->getListagem();

}

if ($objeto == "Impostos") {
    array_push($menus, "Percentual (%)");

    $obj = new \DAO\DaoImpostos();
    $arrList = $obj->getListagem();
    $value1  = $obj->getContagemTotal();
    $obj     = new \DAO\DaoCategorias();
    $value2  = $obj->getCategoriasSemImpostos();
}

?>

<div class="container-fluid" id="<?= $id_div ?>">
    <!-- Título -->
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
                <input type="text" id="input_1" onblur="habilitaBotaoCadastrar()" onkeyup="validaCaractere(this)">
            </div>

            <!-- Input 2 -->
            <div class="card shadow mb-1">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1"><?= $input2 ?></div>
                <input type="text" id="input_2" onblur="habilitaBotaoCadastrar()">
            </div>

            <!-- Input 3 -->
            <?php if (isset($input3) && !empty($input3)) : ?>
            <div class="card shadow mb-4">
                <div class="text-black-50 font-weight-bold text-primary text-uppercase mb-1"><?= $input3 ?></div>
                <?php if (!empty($objeto) && $objeto != "Impostos") : ?>
                    <select  id="input_3" class="custom-select" onblur="habilitaBotaoCadastrar()">
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
                <input type="text" id="input_3">
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
        <!-- Fim Campos -->

        <!-- Buttons -->
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-5">
                <input type="button" id="btnCadastrar" value="CADASTRAR" class="btn btn-success" onclick="cadastrar()" disabled>
            </div>
            <div class="card shadow mb-4">
                <input type="button" value="LIMPAR" class="btn btn-danger" onclick="limparCampos()">
            </div>

            <button id="myBtn" onclick="kakaka()">Campo obrigatório não preenchido !</button>

            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>O campo uepa de preenchimento obrigatório não foi </p>
                </div>

            </div>

        </div>
    </div>
    <!-- Fim Campos de Entrada -->

    <div class="row">
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
                            <i class="fa fa-edit" aria-hidden="true" onclick="alert('hey')"></i>
                            <i class="fa fa-trash" aria-hidden="true" onclick="alert('1');"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function teste(){
    window.alert("O código da tecla pressionada foi: " + event.keyCode);
}
    document.input_1.onkeypress = teste;
    function habilitaBotaoCadastrar() {
        var input1 = $('#input_1').val();
        var input2 = $('#input_2').val();
        var input3 = $('#input_3').val();

        input1.replace(" ")

        if ( input1 != "" && input2 != "" && (input3 != null || input3 != "") ) {
            $('#btnCadastrar').removeAttr('disabled');
        } else {
            $('#btnCadastrar').attr('disabled', 'disabled');
        }
    };

    function validaCaractere(item) {
        alert(item.value);
    }

    function limparCampos() {
        $('#input_1').val("");
        $('#input_2').val("");
        $('#input_3').val("");
    }

    function cadastrar() {
        var input1 = $('#input_1').val();
        var input2 = $('#input_2').val();
        var input3 = $('#input_3').val();

        console.log(input1, input2, input3);
    }

function showModalErro() {
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

}


</script>