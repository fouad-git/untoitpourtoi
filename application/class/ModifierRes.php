<?php

namespace App;



use \PDO;

class ModifierRes
{
  private $req;
  private $sql;
  private $catRes;
  private $dbh;
  private $id;
  private $typeres;
  private $datedebutres;
  private $datefinres;
  private $montantres;
  public function recupereFormres()
  {

    $this->id = $_SESSION['idmodif'];

    if (isset($this->id)) {

      $this->sql = "SELECT RES_Type, RES_DateDebut, RES_DateFin,RES_Montant FROM `ressources` WHERE `ressources`.`RES_Personnes_PER_id` = :id LIMIT 1;";

      $this->dbh = new \App\Database();

      $this->dbh->prepareSql($this->sql);

      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);

      $this->dbh->execReq();

      $this->res = $this->dbh->getAll();

      if (gettype($this->res) === "boolean") {
        header('Location: /');
        exit;
      }
      $this->catRes = $this->res[0]->RES_Type;
    }
    if (!empty($_POST)) {


      $this->req = "UPDATE ressources SET `RES_Type`=:typeres, `RES_DateDebut`=:debutres,`RES_DateFin`=:finres,`RES_Montant`=:montant WHERE `ressources`.`RES_Personnes_PER_id` = :id LIMIT 1;";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->req);
      $this->typeres = $_POST['restype'];
      $this->datedebutres = $_POST['datedebutres'];
      $this->datefinres = $_POST['datefinres'];
      $this->montantres = $_POST['montantres'];
      $this->id = $_SESSION['idmodif'];

      $this->dbh->bindP(':typeres', $this->typeres, PDO::PARAM_STR);
      $this->dbh->bindV(':debutres', strftime("%Y-%m-%d", strtotime($this->datedebutres)), PDO::PARAM_STR);
      $this->dbh->bindP(':montant', $this->montantres, PDO::PARAM_INT);
      $this->dbh->bindV(':finres', strftime("%Y-%m-%d", strtotime($this->datefinres)), PDO::PARAM_STR);
      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();
      header('Location: /modifierNui');
    }
    $chargeTwig = new \App\Twig('pages/modifierRes.html.twig');
    $chargeTwig->render(['res' => $this->res, 'catRes' => $this->catRes]);
  } //fin fonction
}//fin class