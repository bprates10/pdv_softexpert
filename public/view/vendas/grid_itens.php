<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/03/2019
 * Time: 22:03
 */

if (isset($_POST['acao'])) {
    if ($_POST['acao'] == 'adiciona_item_grid') {
        var_dump($_POST);
    }
}
?>

<!-- Grid -->
<div class="col-xl-6 col-lg-6">
    <div class="content table-responsive table-full-width">
        <table id="grid" class="table table-hover table-striped" cellspacing="0" width="100%">
            <thead class="header">
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </thead>
            <tbody>
            <?php
            if (isset($carrinho)) :
            foreach ($carrinho as $item) : ?>
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
            <?php endforeach;
            else : ?>
            <td></td>
            <td></td>
            <td></td>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
