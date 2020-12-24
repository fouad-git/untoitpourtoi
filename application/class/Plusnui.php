<?php

namespace App;



use \PDO;
use Twig\Extension\GlobalsInterface;

class Plusnui
{  
  /**
   * id
   *
   * @var mixed
   */
  private $id;  
  /**
   * autresNui
   *
   * @return void
   */
  public function autresNui()
  {
    if (isset($_POST['nuitees']) && isset($_GET['id'])) {
      $_SESSION['idautresnui'] = $_GET['id'];
      $this->id = $_SESSION['idautresnui'];
      foreach ($_POST['nuientre'] as $i => $value) {
        $this->dateEntnui = $_POST['nuientre'][$i];
        $this->motEntnui = $_POST['nuientmotif'][$i];
        $this->dateSortnui = $_POST['nuisortie'][$i];
        $this->motSortnui = $_POST['nuisortmotif'][$i];
        $this->comentnui = $_POST['nuicoment'][$i];
        $this->id = $_SESSION['idautresnui'];
        $this->req = "INSERT INTO nuitees (NUI_Personnes_PER_Id, NUI_DateEntree, NUI_MotifEntree, NUI_DateSortie, NUI_MotifSortie, NUI_Commentaire) VALUES (:id,:entnui,:motentnui,:sortnui,:motsortnui,:comentnui);";
        $this->dbh = new \App\Database();
        $this->dbh->prepareSql($this->req);
        $this->dbh->bindP(':id', $this->id, PDO::PARAM_STR);
        $this->dbh->bindV(':entnui', strftime("%Y-%m-%d", strtotime($this->dateEntnui)), PDO::PARAM_STR);
        $this->dbh->bindP(':motentnui', $this->motEntnui, PDO::PARAM_STR);
        $this->dbh->bindV(':sortnui', strftime("%Y-%m-%d", strtotime($this->dateSortnui)), PDO::PARAM_STR);
        $this->dbh->bindP(':motsortnui', $this->motSortnui, PDO::PARAM_STR);
        $this->dbh->bindP(':comentnui', $this->comentnui, PDO::PARAM_STR);
        $this->dbh->execReq();
      }
      header('Location: /');
    }
    $chargeTwig = new \App\Twig('pages/nuiteesplus.html.twig');
    $chargeTwig->render([]);
    return  true;
  } //fin function
}//fin class
