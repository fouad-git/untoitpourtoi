<?php

namespace App;


use \PDO;

class Supprimer
{  
  /**
   * sql
   *
   * @var mixed
   */
  private $sql;  
  /**
   * dbh
   *
   * @var mixed
   */
  private $dbh;  
  /**
   * id
   *
   * @var mixed
   */
  private $id;
  
  /**
   * supprimePersonnes
   *
   * @return void
   */
  public function supprimePersonnes()
  {
    $this->id = $_GET['id'];
    if (isset($_GET['id'])) {
      $this->sql = "DELETE FROM `personnes` WHERE `personnes`.`PER_id` = :id;";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->sql);
      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();
    }
    header('Location:/');
  }
}
