<?php

namespace App;


use \PDO;

class Afficher
{
  /**
   * sql
   *
   * @var mixed
   */
  private $sql;
  /**
   * result
   *
   * @var mixed
   */
  private $result;
  /**
   * dbh
   *
   * @var mixed
   */
  private $dbh;

  /**
   * afficheTous
   *
   * @return void
   */
  public function afficheTous()
  {
    $this->sql = "SELECT * FROM personnes INNER JOIN piecesidentite ON personnes.PER_id = piecesidentite.PID_Personnes_PER_id INNER JOIN ressources ON personnes.PER_id = ressources.RES_Personnes_PER_id ;";
    $this->dbh = new \App\Database();
    $this->dbh->prepareSql($this->sql);
    $this->dbh->execReq();
    $this->result = $this->dbh->getAll();

    $resultO = new \App\Afficherun();
    $resultO->afficheUn();
    $chargeTwig = new \App\Twig('pages/index.html.twig');
    $chargeTwig->render(['listePersonnes' => $this->result, 'listePersonne' => $resultO->afficheUn()]);
    return  true;
  }
}
