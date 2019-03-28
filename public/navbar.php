<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 12/03/2019
 * Time: 22:09
 */
?>

<!-- Início Barra Lateral / Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Icon /Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Gestão <sup>PDV</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    <div class="sidebar-heading">
        Cadastros
    </div>

    <!-- Nav Item - Cadastros / Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Cadastro</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cadastros:</h6>
                <!-- antiga buttons.html, cards.html, cards.html -->
                <a class="collapse-item" href="index.php?page=cadastroProdutos">Produtos</a>
                <a class="collapse-item" href="index.php?page=cadastroCategorias">Categorias</a>
                <a class="collapse-item" href="index.php?page=cadastroImpostos">Impostos</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Relatórios / Pages Collapse Menu - ->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-adobe"></i>
            <span>Relatórios</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Relatórios de:</h6>
                <!- - antiga buttons.html, cards.html, cards.html - ->
                <a class="collapse-item" href="index.php?page=cadastroProdutos">Produtos Cadastrados</a>
                <a class="collapse-item" href="index.php?page=cadastroCategorias">Categorias Cadastradas</a>
                <a class="collapse-item" href="index.php?page=cadastroImpostos">Impostos Cadastrados</a>
            </div>
        </div>
    </li-->

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>PDV</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Balcão:</h6>
                <a class="collapse-item" href="index.php?page=telaVendas">Venda</a>
                <!--a class="collapse-item" href="utilities-border.html">Estorno</a>
                <a class="collapse-item" href="utilities-other.html">Other</a-->
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
