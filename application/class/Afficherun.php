<?php

namespace App;


use \PDO;

class Afficherun
{  
  /**
   * sql
   *
   * @var mixed
   */
  private $sql;  
  /**
   * resultOne
   *
   * @var mixed
   */
  private $resultOne;  
  /**
   * dbh
   *
   * @var mixed
   */
  private $dbh;
  
  /**
   * afficheUn
   *
   * @return void
   */
  public function afficheUn()
  {
    $this->sql = "SELECT * FROM personnes INNER JOIN piecesidentite ON personnes.PER_id = piecesidentite.PID_Personnes_PER_id INNER JOIN ressources ON personnes.PER_id = ressources.RES_Personnes_PER_id INNER JOIN nuitees ON personnes.PER_id = nuitees.NUI_Personnes_PER_id LIMIT 1 ;";
    $this->dbh = new \App\Database();
    $this->dbh->prepareSql($this->sql);
    $this->dbh->execReq();

    $this->resultOne = $this->dbh->getAll();

    return $this->resultOne;
  }
}
