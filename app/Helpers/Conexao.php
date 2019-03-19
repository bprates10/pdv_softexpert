<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 15/03/2019
 * Time: 23:22
 */

namespace Helpers;

class Conexao
{
    private $host;
    private $port;
    private $base;
    private $user;
    private $pass;

    private $conn;

    public function __construct($params = [])
    {
        $this->host = isset($params['host']) ? $params['host'] : '';
        $this->port = isset($params['port']) ? $params['port'] : '';
        $this->base = isset($params['base']) ? $params['base'] : '';
        $this->user = isset($params['user']) ? $params['user'] : '';
        $this->pass = isset($params['pass']) ? $params['pass'] : '';

        if (empty($this->host) || empty($this->port) || empty($this->base) || empty($this->user) || empty($this->pass)) {
            throw new \Exception("Dados não informados !");
            return false;
        } else {
            $strConn = "host=$this->host port=$this->port dbname=$this->base user=$this->user password=$this->pass";
            $this->conn = pg_connect($strConn) or die("Impossível abrir conexão");
            return $this->conn;
        }
    }

    public function query($sql) {
        return pg_query($this->conn, $sql);
    }

    public function connect() {
        $this->conn = pg_connect("host=$this->host port=$this->port dbname=$this->base user=$this->user password=$this->pass");
        return $this->conn;
    }

    public function close() {
        if ($this->conn)
            $this->conn->pg_close();
    }

    public function fetchAll($res) {
        if ($res) {
            var_dump($res);
            //return $res->fetch_all(MYSQLI_ASSOC);
        }
    }

    /*
    public function fetch($res) {
        if ($res)
            return $res->fetch(MYSQLI_ASSOC);
    }
    public function fetch_assoc ($res) {
    }*/
}