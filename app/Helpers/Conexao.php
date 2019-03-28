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

            $this->checkTable('impostos');
            $this->checkTable('categorias');
            $this->checkTable('produtos');
            $this->checkTable('vendas');
            $this->checkTable('vendas_item');
            $this->checkTable('vendas_imposto');

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

    /* Verifica se a tabela existe na base de dados
     * Recebe uma string com o nome da tabela
     * Não retorna valor
    */
    public function checkTable($table) {
        $sql = "select count(*) as cnt from pg_tables where tablename = '$table' and schemaname = ANY(current_schemas(true))";

        $res = $this->query($sql);
        $result = false;
        if ($res) {
            while ($rs = pg_fetch_assoc($res)) {
                if (isset($rs['cnt']) && $rs['cnt'] > 0) {
                    $result = true;
                }
            }
        }

        // Cria a tabela se ela não existir
        if (!$result) {
            $this->createTable($table);
        }
    }

    /* Cria uma tabela na base de dados
     * Recebe uma string com o nome da tabela
     * Não retorna valor
    */
    public function createTable($table) {
        $params     = [];
        $params[0]  = "id Serial PRIMARY KEY";

        switch ($table) {
            case 'produtos':
                $params[1] = ",codigo text";
                $params[2] = ",descricao text";
                $params[3] = ",preco float";
                $params[4] = ",id_categoria integer references categorias(id)";
                break;
            case 'categorias':
                $params[1] = ",descricao text";
                $params[2] = ",id_imposto integer references impostos(id)";
                $params[3] = "";
                $params[4] = "";
                break;
            case 'impostos':
                $params[1] = ",descricao text";
                $params[2] = ",valor numeric";
                $params[3] = "";
                $params[4] = "";
                break;
            case 'vendas':
                $params[1] = ",valor_total float";
                $params[2] = ",valor_imposto float";
                $params[3] = ",ativo text";
                $params[4] = "";
                break;
            case 'vendas_item':
                $params[1] = ",valor_total float";
                $params[2] = ",id_venda integer";
                $params[3] = ",quantidade integer";
                $params[4] = "";
                break;
            case 'vendas_imposto':
                $params[1] = ",descricao text";
                $params[2] = ",id_vendas_item integer";
                $params[3] = ",valor float";
                $params[4] = "";
                break;
        }

        $sql = "CREATE TABLE $table
                (
                    $params[0] " . " $params[1] " . " $params[2] " . " $params[3] " . " $params[4]
                )";

        $this->query($sql);

    }
}