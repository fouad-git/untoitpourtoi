<?php

namespace App;



use \PDO;

class ModifierNui
{
  private $req;
  private $sql;
  private $nuitees;
  private $dbh;
  private $id;

  public function recupereFormnui()
  {

    $this->id = $_SESSION['idmodif'];

    if (isset($this->id)) {
      $this->sql = "SELECT NUI_DateEntree, NUI_MotifEntree, NUI_DateSortie,	NUI_MotifSortie,NUI_Commentaire  FROM `nuitees` WHERE `nuitees`.`NUI_Personnes_PER_id` = :id LIMIT 1;";

      $this->dbh = new \App\Database();

      $this->dbh->prepareSql($this->sql);

      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);

      $this->dbh->execReq();

      $this->nuitees = $this->dbh->getAll();


      if (gettype($this->nuitees) === "boolean") {
        header('Location: /');
        exit;
      }
    }
    if (!empty($_POST)) {


      $this->req = "UPDATE nuitees SET `NUI_DateEntree`=:entnui, `NUI_MotifEntree`=:motentnui,`NUI_DateSortie`=:sortnui,`NUI_MotifSortie`=:motsortnui, `NUI_Commentaire`=:comentnui WHERE `nuitees`.`NUI_Personnes_PER_id` = :id LIMIT 1;";
      $this->dateEntnui = $_POST['nuientre'];
      $this->motEntnui = $_POST['nuientmotif'];
      $this->dateSortnui = $_POST['nuisortie'];
      $this->motSortnui = $_POST['nuisortmotif'];
      $this->comentnui = $_POST['nuicoment'];
      $this->id = $_SESSION['idmodif'];

      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->req);
      $this->dbh->bindV(':entnui', strftime("%Y-%m-%d", strtotime($this->dateEntnui)), PDO::PARAM_STR);
      $this->dbh->bindP(':motentnui', $this->motEntnui, PDO::PARAM_STR);
      $this->dbh->bindV(':sortnui', strftime("%Y-%m-%d", strtotime($this->dateSortnui)), PDO::PARAM_STR);
      $this->dbh->bindP(':motsortnui', $this->motSortnui, PDO::PARAM_STR);
      $this->dbh->bindP(':comentnui', $this->comentnui, PDO::PARAM_STR);
      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();
      header('Location: /');
    }
    $chargeTwig = new \App\Twig('pages/modifierNui.html.twig');
    $chargeTwig->render(['nuitees' => $this->nuitees]);
  } //fin fonction
}//fin class