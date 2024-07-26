<?php

class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $name = DB_NAME;

  private $dbh;
  private $stmt;

  public static function init()
  {
    return new Database;
  }

  public function __construct()
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name . ';charset=utf8mb4';

    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute()
  {
    $this->stmt->execute();
  }

  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function singleAsClass($class)
  {
    if (!class_exists($class)) {
      throw new InvalidArgumentException("Class $class does not exist.");
    }
    $this->execute();
    $this->stmt->setFetchMode(PDO::FETCH_CLASS, $class);
    return $this->stmt->fetch();
  }

  public function resultSetAsClass($class)
  {
    if (!class_exists($class)) {
      throw new InvalidArgumentException("Class $class does not exist.");
    }

    $this->execute();
    $this->stmt->setFetchMode(PDO::FETCH_CLASS, $class);
    return $this->stmt->fetchAll();
  }

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }

  public function count()
  {
    return $this->stmt->fetchColumn();
  }
}
