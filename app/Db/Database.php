<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
  /**
   * Nome da tabela a ser manipulada
   */
  private $table;

  /**
   * Instancia de conexão com o banco de dados
   */
  private $connection;

  /**
   * Define a tabela e instancia e conexão
   */
  public function __construct($table = null)
  {
    $this->table = $table;
    $this->setConnection();
  }

  /**
   * Método responsável por criar uma conexão com o banco de dados
   */
  private function setConnection()
  {
    try {
      $this->connection = new PDO('mysql:host=' . getenv('HOST') . ';dbname=' . getenv('DBSA'), getenv('USER'), getenv('PASS'));
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('ERROR: ' . $e->getMessage());
    }
  }

  /**
   * Método responsável por executar queries dentro do banco de dados
   */
  public function execute($query, $params = [])
  {
    try {
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    } catch (PDOException $e) {
      die('ERROR: ' . $e->getMessage());
    }
  }

  /**
   * Método responsável por inserir dados no banco
   * COMO FUNCIONA ///////////////////////////////
   * $obDatabase = new Database('vagas');
   * $data =[
   * 'titulo'    => $this->titulo,
   * 'descricao' => $this->descricao,
   * 'ativo'     => $this->ativo,
   * 'data'      => $this->data,
   * ]
    $this->id = $obDatabase->insert($data);
    return true;  // RETORNA O ID
    ////////////////////////////////////////////////
   */
  public function insert($values)
  {
    //DADOS DA QUERY
    $fields = array_keys($values);
    $binds  = array_pad([], count($fields), '?');

    //MONTA A QUERY
    $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

    //EXECUTA O INSERT
    $this->execute($query, array_values($values));

    //RETORNA O ID INSERIDO
    return $this->connection->lastInsertId();
  }

  /**
   * Método responsável por executar uma consulta no banco
   * COMO FUNCIONA /////////////////////////////////////
   * $where = 'status=1';
   * $order = '';
   * $limit = '';
   * $lista = (new Database('cliente'))->select($where)->fetchAll(PDO::FETCH_CLASS);
   * if (!$lista) {
   *   echo 'não existe';
   * } else {
   *   foreach ($lista as $vaga) {
   *   }
   *   echo '<pre>';
   *   print_r($vaga);
   *   echo '</pre>';
   *   exit();
   * }
   * 
   */
  public function select($where = null, $order = null, $limit = null, $fields = '*')
  {
    //DADOS DA QUERY
    $where = strlen($where) ? 'WHERE ' . $where : '';
    $order = strlen($order) ? 'ORDER BY ' . $order : '';
    $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

    //MONTA A QUERY
    $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

    //EXECUTA A QUERY
    return $this->execute($query);
  }

  /**
   * Método responsável por executar uma consulta no banco aonde podemos criar o select
   *  * COMO FUNCIONA /////////////////////////////////////
   * $select = 'SELECT nome, cel from cliente';
   * $lista = (new Database())->fullSelect($select)->fetchAll(PDO::FETCH_CLASS);
   * if (!$lista) {
   *   echo 'não existe';
   * } else {
   *   foreach ($lista as $vaga) {
   *   }
   *   echo '<pre>';
   *   print_r($vaga);
   *   echo '</pre>';
   *   exit();
   * }
   */
  public function fullSelect($select)
  {
    //MONTA A QUERY
    $query = '' . $select . '';

    //EXECUTA A QUERY
    return $this->execute($query);
  }

  /**
   * Método responsável por executar atualizações no banco de dados
   * COMO FUNCIONA //////////////////////////////
   * $data = [
   * 'nome' => 'Fabio Augusto da Silva Amaral',
   * 'data_nasc' => '10/07/1981',
   *  ];
   *  $id = '9';
   * update = (new Database('cliente'))->update('id = ' . $id, $data);
   * if ($update >= 1) {
   * echo '<pre>';
   * print_r($update);
   * echo '</pre>';
   * exit();
   * } else {
   * echo 'erro ao atualizar';
   *
   */
  public function update($where, $values)
  {
    //DADOS DA QUERY
    $fields = array_keys($values);

    //MONTA A QUERY
    $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

    //EXECUTAR A QUERY
    //RETORNA SUCESSO
    return $this->execute($query, array_values($values))->rowCount();
  }

  /**
   * Método responsável por excluir dados do banco
   * COMO FUNCIONA //////////////////////////////
   * $id = '11';
   * $delete = (new Database('cliente'))->delete('id = ' . $id);
   * if ($delete >= 1) {
   * echo '<pre>';
   * print_r($delete);
   * echo '</pre>';
   * exit();
   * } else {
   * echo 'Não deletado';
   * }
   */

  public function delete($where)
  {
    //MONTA A QUERY
    $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

    //EXECUTA A QUERY
    //RETORNA SUCESSO
    return $this->execute($query)->rowCount();
  }
}
