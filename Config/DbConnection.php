<?php

class DbConnection
{
  private $host = 'localhost';
  private $username = 'root';
  private $password = '';
  private $DbName = 'chil_cdcms_database';
  private $port = 8090;
  public $conn;


  public function Connect()
  {
      $this->conn = new mysqli($this->host,$this->username,$this->password,$this->DbName, $this->port);
      if ($this->conn->connect_error){
          echo "Connection Problem";
      }
      return $this->conn;
  }

}
