<?php

namespace App;



use \PDO;

class ModifierPid
{
  private $req;
  private $sql;
  private $catPid;
  private $dbh;
  private $id;
  private $typepid;
  private $payspid;
  private $datedelivrance;
  private $dateexpiration;
  public function recupereFormpid()
  {
    $this->id = $_SESSION['idmodif'];
    if (isset($this->id)) {
      $this->sql = "SELECT `PID_Type`,`PID_Pays`,`PID_DateDelivrance`,`PID_DateExpiration` FROM `piecesidentite` WHERE `piecesidentite`.`PID_Personnes_PER_id` = :id LIMIT 1;";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->sql);
      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();
      $this->pid = $this->dbh->getAll();
      if (gettype($this->pid) === "boolean") {
        header('Location: /');
        exit;
      }
      $this->catPid = $this->pid[0]->PID_Type;
    }
    if (!empty($_POST)) {

      $this->req = "UPDATE piecesidentite SET `PID_Type`=:typepid, `PID_Pays`=:pays,`PID_DateDelivrance`=:delivrance,`PID_DateExpiration`=:expiration WHERE `piecesidentite`.`PID_Personnes_PER_id` = :id LIMIT 1;";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->req);
      $this->typepid = $_POST['pidType'];
      $this->payspid = $_POST['pidPays'];
      $this->datedelivrance = $_POST['datedelivrance'];
      $this->dateexpiration = $_POST['dateexpiration'];
      $this->id = $_SESSION['idmodif'];

      $this->dbh->bindP(':typepid', $this->typepid, PDO::PARAM_STR);
      $this->dbh->bindP(':pays', $this->payspid, PDO::PARAM_STR);
      $this->dbh->bindV(':delivrance', strftime("%Y-%m-%d", strtotime($this->datedelivrance)), PDO::PARAM_STR);
      $this->dbh->bindV(':expiration', strftime("%Y-%m-%d", strtotime($this->dateexpiration)), PDO::PARAM_STR);
      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();
      header('Location: /modifierRes');
    }
    $chargeTwig = new \App\Twig('pages/modifierPid.html.twig');
    $chargeTwig->render(['pid' => $this->pid, 'catPid' => $this->catPid]);
  } //fin fonction
}//fin class