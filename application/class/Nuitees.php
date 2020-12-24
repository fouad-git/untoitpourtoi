<?php

namespace App;

use \PDO;

class Nuitees
{  
  /**
   * dateEntnui
   *
   * @var mixed
   */
  private $dateEntnui;  
  /**
   * motEntnui
   *
   * @var mixed
   */
  private $motEntnui;  
  /**
   * dateSortnui
   *
   * @var mixed
   */
  private $dateSortnui;  
  /**
   * motSortnui
   *
   * @var mixed
   */
  private $motSortnui;  
  /**
   * comentnui
   *
   * @var mixed
   */
  private $comentnui;  
  /**
   * lastid
   *
   * @var mixed
   */
  private $lastid;  
  /**
   * req
   *
   * @var mixed
   */
  private $req;  
  /**
   * dbh
   *
   * @var mixed
   */
  private $dbh;
  
  /**
   * ajoutsNuitees
   *
   * @return void
   */
  public function ajoutsNuitees()
  {

    if (isset($_POST['nuitees'])) {

      foreach ($_POST['nuientre'] as $i => $value) {

        $this->dateEntnui = $_POST['nuientre'][$i];
        $this->motEntnui = $_POST['nuientmotif'][$i];
        $this->dateSortnui = $_POST['nuisortie'][$i];
        $this->motSortnui = $_POST['nuisortmotif'][$i];
        $this->comentnui = $_POST['nuicoment'][$i];
        $this->lastid = $_SESSION['lastid'];
        $this->req = "INSERT INTO nuitees (NUI_Personnes_PER_Id, NUI_DateEntree, NUI_MotifEntree, NUI_DateSortie, NUI_MotifSortie, NUI_Commentaire) VALUES (:lastid,:entnui,:motentnui,:sortnui,:motsortnui,:comentnui);";
        $this->dbh = new \App\Database();
        $this->dbh->prepareSql($this->req);
        $this->dbh->bindP(':lastid', $this->lastid, PDO::PARAM_STR);
        $this->dbh->bindV(':entnui', strftime("%Y-%m-%d", strtotime($this->dateEntnui)), PDO::PARAM_STR);
        $this->dbh->bindP(':motentnui', $this->motEntnui, PDO::PARAM_STR);
        $this->dbh->bindV(':sortnui', strftime("%Y-%m-%d", strtotime($this->dateSortnui)), PDO::PARAM_STR);
        $this->dbh->bindP(':motsortnui', $this->motSortnui, PDO::PARAM_STR);
        $this->dbh->bindP(':comentnui', $this->comentnui, PDO::PARAM_STR);
        $this->dbh->execReq();
      }
      header('Location: /');
    }
    $chargeTwig = new \App\Twig('pages/nuitees.html.twig');
    $chargeTwig->render([]);
    return  true;
  }
}
