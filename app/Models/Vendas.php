<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/03/2019
 * Time: 23:19
 */

namespace Models;


use DAO\DaoVendas;

class Vendas
{
    private $id;
    private $ativo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    function __construct()
    {
        $dao = new DaoVendas();
        $this->setId($dao->initVenda());
        //return $dao->initVenda();
    }

    function verificaVendaAnterior() {
        $dao = new DaoVendas();
        $dao->validaUltimaVenda();
    }
}