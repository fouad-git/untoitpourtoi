<?php

namespace App;


use \PDO;

class ModifierPer
{
  private $sql;
  private $dbh;
  private $personnes;
  private $genre;
  private $situation_familiale;
  private $nom;
  private $prenom;
  private $date_naissance;
  private $nationalite;
  private $req;
  private $id;
  private $catGenre;
  private $catSituationf;
  public function recupereFormper()
  {

    $_SESSION['idmodif'] = $_GET['id'];
    $this->id = $_SESSION['idmodif'];
    if (isset($_GET['id'])) {
      $this->sql = "SELECT `PER_Nom`,`PER_Prenom`,`PER_DateNaissance`,`PER_Genre`,`PER_Nationalite`,`PER_SituationFamiliale` FROM `personnes` WHERE PER_id = :id;";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->sql);
      $this->dbh->bindV(":id", $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();
      $this->personnes = $this->dbh->getAll();
      if (gettype($this->personnes) === "boolean") {
        header('Location: /');
        exit;
      }
      $this->catGenre = $this->personnes[0]->PER_Genre;
      $this->catSituationf = $this->personnes[0]->PER_SituationFamiliale;
    }
    if (!empty($_POST)) {
      $this->req = "UPDATE personnes SET `PER_Genre`=:genre, `PER_nom`=:nom,`PER_prenom`=:prenom,`PER_DateNaissance`=:datenaissance, `PER_Nationalite`=:nationalite, `PER_SituationFamiliale`=:situationfamiliale WHERE `personnes`.`PER_id` = :id;";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->req);
      $this->genre = $_POST['genre'];
      $this->situation_familiale = $_POST['situation_familiale'];
      $this->nom = $_POST['nom'];
      $this->prenom = $_POST['prenom'];
      $this->date_naissance = $_POST['date_naissance'];
      $this->nationalite = $_POST['nationalite'];
      $this->id = htmlentities($_GET['id']);

      $this->dbh->bindP(':genre', $this->genre, PDO::PARAM_STR);
      $this->dbh->bindP(':nom', $this->nom, PDO::PARAM_STR);
      $this->dbh->bindP(':prenom', $this->prenom, PDO::PARAM_STR);
      $this->dbh->bindV(':datenaissance', strftime("%Y-%m-%d", strtotime($this->date_naissance)), PDO::PARAM_STR);
      $this->dbh->bindP(':nationalite', $this->nationalite, PDO::PARAM_STR);
      $this->dbh->bindP(
        ':situationfamiliale',
        $this->situation_familiale,
        PDO::PARAM_STR
      );
      $this->dbh->bindV(':id', $this->id, PDO::PARAM_INT);
      $this->dbh->execReq();

      header('Location: /modifierPid');
    }
    $chargeTwig = new \App\Twig('pages/modifierPer.html.twig');
    $chargeTwig->render(['personnes' => $this->personnes, 'catGenre' => $this->catGenre, 'catSituationf' => $this->catSituationf]);
  }
}
