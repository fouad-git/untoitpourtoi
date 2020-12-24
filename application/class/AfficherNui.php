<?php

namespace App;


use \PDO;

class AfficherNui
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
   * id
   *
   * @var mixed
   */
  private $id;  
  /**
   * afficheNuitees
   *
   * @return void
   */
  public function afficheNuitees()
  {
    $_SESSION['idnuitees'] = $_GET['id'];
    $this->id = $_SESSION['idnuitees'];


    if (isset($_GET['id'])) {
      $this->sql = "SELECT * FROM personnes INNER JOIN nuitees ON personnes.PER_id = nuitees.NUI_Personnes_PER_id WHERE NUI_Personnes_PER_id = :id ;";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->sql);
      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();
      $this->result = $this->dbh->getAll();
    } //finsi

    $chargeTwig = new \App\Twig('pages/affichernui.html.twig');
    $chargeTwig->render(['listeNuitees'  => $this->result]);
    return  true;
  } //fin function

}//fin class
