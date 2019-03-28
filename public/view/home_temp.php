<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 12/03/2019
 * Time: 22:47
 */

?>

<!-- remover quando possivel -->

<div class="div_principal">
    <p> A solução apresentada possui:</p>
    <br/>
    <p> - Dump do banco de dados PostgreSQL, versão 9.4, cujas credenciais são:</p>
    <p> > Alias: pdv_softexpert</p>
    <p> > Password: 10</p>
    <p> - Criação de tabelas dinâmicas</p> e em tempo de execução</p>
    <p> - Menu de Cadastro de produtos</p>
    <p> - Menu de Cadastro de Categorias</p>
    <p> - Menu de Cadastro de Impostos</p>
    <p> - Tela de vendas, onde:
    <p> > Selecionando o produto, é permitido informar a quantidade a ser vendida</p>
    <p> > Informando a quantidade, o sistema calcula o total do produto, valor do imposto e total da venda</p>
    <p> > Botão para adicionar mais produtos na mesma NF</p>

    <p> Não foram utilizados frameworks, à exceção do bootstrap para o front-end.</p>
    <p> Em back-end, foi utilizada a biblioteca JQuery do Javascript, embora o Ajax utilizado possa ser utilizado em JS sem a utilização da biblioteca.</p>
    <p> O sistema foi criado utilizado o pattern MVC para distinguir as camadas da aplicação.</p>
    <p> Foi utilizado padrão Singleton para acesso concorrente.</p>
    <p> Os campos do front-end são validados em sua grande maioria (eu diria 100%, embora não pude realizar todos os testes pretendidos).</p>
    <p> O módulo de Cadastros utiliza um único frame dinâmico que se adapta ao menu de cadastro pretendido (Produto, Categoria ou Imposto).</p>
    <p> Um Produto sem Categoria não pode ser cadastrado;</p>
    <p> Uma Categoria sem Imposto também não pode ser cadastrada;</p>
    <p> Logo, o fluxo a ser seguido deve ser:</p>
    <p> - Cadastro de imposto;</p>
    <p> - Cadastro de categoria, vinculando o imposto;</p>
    <p> - Cadastro de produto, vinculando a categoria.</p>

    <p> A aplicação não está completa, pois abri mão dos seguintes componentes para cumprir o prazo estipulado:</p>
    <p> - Não existem chaves estrangeiras nas tabelas de vendas, vendas_item e vendas_imposto.</p>
    <p> - O botão Finalizar (a venda) não foi implementado.</p>
    <p> - A tela inicial da aplicação não foi implementada.</p>
    <p> - As grids dinâmicas, embora prontas, não foram implementadas. Entenda-se por grid dinâmica:</p>
    <p> > Quando um item é cadastrado, o Ajax deveria atualizar assincronamente a grid de itens cadastrados.</p>
    <p> > Quando uma categoria é cadastrada, o Ajax deveria atualizar assincronamente a grid de categorias cadastrados.</p>
    <p> > Quando um imposto é cadastrado, o Ajax deveria atualizar assincronamente a grid de impostos cadastrados.</p>
    <p> > Quando um item é adicionado à NF, o Ajax deveria atualizar assincronamente a grid de itens da NF cadastrados.</p>

    <p> No mais, espero que aprecie o projeto enviado. Embora incompleta, a aplicação cumpre com as exigências do projeto.</p>
    <p> Em no máximo 2 dias úteis a aplicação estará completa, podendo ser encontrada em github.com/bprates10/pdv_softexpert.</p>
    <p> Obrigado, até mais.</p>
</div>