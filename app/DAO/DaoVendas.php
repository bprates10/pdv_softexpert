<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/03/2019
 * Time: 23:21
 */

namespace DAO;

class DaoVendas extends BaseDAO
{
    public function initVenda() {
        $con = $this->getConexao();
        $con->connect();

        $lUltimaVenda = $this->validaUltimaVenda();

        // Se não encontrar venda, insere uma nova
        if (!$lUltimaVenda) {
            $sql = "insert into vendas (ativo) values ('S')";
            $con->query($sql);
            return $this->getUltimaVenda();
        }
        // Se encontrar venda e a variável for numérica
        else if ($lUltimaVenda && is_numeric($lUltimaVenda)) {
            return $this->getUltimaVenda();
        }
        else {
            //var_dump("nova venda");
            return $this->getUltimaVenda(1);
        }
    }

    public function getUltimaVenda($increment = 0) {

        $con = $this->getConexao();
        $con->connect();

        $sql = "select max(id) from vendas";
        $res = $con->query($sql);
        $idVenda = pg_fetch_assoc($res);
        $idVenda = (int)$idVenda['max'];
        //var_dump($idVenda, $increment);
        return $idVenda + $increment ;
    }

    public function validaUltimaVenda() {
        $con = $this->getConexao();
        $con->connect();

        $sql = "select max(id) from vendas";
        $res = $con->query($sql);

        if ($res) {
            $idVenda = pg_fetch_assoc($res);

            // Verifica se existe venda no sistema
            if (!empty($idVenda['max'])) {
                $idVenda = $idVenda['max'];
                $sql = "select count(*) as cnt from vendas_item where id_venda = $idVenda";
                $res = $con->query($sql);

                // Verifica se a ultima venda possui item. Se possuir, retorna o ultimo ID + 1
                if (isset($res['cnt'])) {
                    return $idVenda + 1;
                }
                // Se não possuir, retorna o ultimo ID para continuar a venda
                else {
                    return $idVenda;
                }
            // Se não existir, retorna FALSE
            } else {
                return false;
            }
        // Problema
        } else {
            die("ERRO !");
        }

    }
}