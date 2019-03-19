<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/03/2019
 * Time: 17:27
 */

namespace Models;


class Categorias
{
    private $id;
    private $descricao;
    private $id_imposto;

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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getIdImposto()
    {
        return $this->id_imposto;
    }

    /**
     * @param mixed $id_imposto
     */
    public function setIdImposto($id_imposto)
    {
        $this->id_imposto = $id_imposto;
    }
}