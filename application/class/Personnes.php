<?php

namespace App;



use \PDO;
use Twig\Extension\GlobalsInterface;

class Personnes
{  
  /**
   * genre
   *
   * @var mixed
   */
  private $genre;  
  /**
   * situation_familiale
   *
   * @var mixed
   */
  private $situation_familiale;  
  /**
   * nom
   *
   * @var mixed
   */
  private $nom;  
  /**
   * prenom
   *
   * @var mixed
   */
  private $prenom;  
  /**
   * date_naissance
   *
   * @var mixed
   */
  private $date_naissance;  
  /**
   * nationalite
   *
   * @var mixed
   */
  private $nationalite;  
  /**
   * age
   *
   * @var mixed
   */
  private $age;  
  /**
   * sql
   *
   * @var mixed
   */
  private $sql;  
  /**
   * ajouts
   *
   * @return void
   */
  public function ajouts()
  {
    if (isset($_POST['submit'])) {

      $this->genre = $_POST['genre'];
      $this->situation_familiale = $_POST['situation_familiale'];
      $this->nom = $_POST['nom'];
      $this->prenom = $_POST['prenom'];
      $this->date_naissance = $_POST['date_naissance'];
      $this->nationalite = $_POST['nationalite'];
      $this->sql = "INSERT INTO `personnes` (`PER_Genre`,`PER_nom`, `PER_prenom`, `PER_DateNaissance`, `PER_Nationalite`, `PER_SituationFamiliale`) VALUES (:genre, :nom, :prenom, :datenaissance, :nationalite, :situationfamiliale);";
      $this->dbh = new \App\Database();
      $this->dbh->prepareSql($this->sql);
      $this->dbh->bindP(':genre', $this->genre, PDO::PARAM_STR);
      $this->dbh->bindP(':nom', $this->nom, PDO::PARAM_STR);
      $this->dbh->bindP(':prenom', $this->prenom, PDO::PARAM_STR);
      $this->dbh->bindV(':datenaissance', strftime("%Y-%m-%d", strtotime($this->date_naissance)), PDO::PARAM_STR);
      $this->dbh->bindP(':nationalite', $this->nationalite, PDO::PARAM_STR);
      $this->dbh->bindP(':situationfamiliale', $this->situation_familiale, PDO::PARAM_STR);
      $s = $this->dbh->execReq();
      var_dump($s);
      $this->result = $this->dbh->lastId();
      $_SESSION['lastid'] = $this->result;

      // calcul age
      $this->age = new \App\Age();
      $this->age->insererAge();

      header('Location: /pid');
    }
    $chargeTwig = new \App\Twig('pages/ajouter.html.twig');
    $chargeTwig->render(['genre' => $this->genre, 'situation' => $this->situation_familiale, 'nom' => $this->nom, 'prenom' => $this->prenom, 'datenaissance' => $this->date_naissance, 'nationalite' => $this->nationalite]);
    return  true;
  }
}
