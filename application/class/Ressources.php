<?php

namespace App;

use \PDO;

class Ressources
{    
    /**
     * typeres
     *
     * @var mixed
     */
    private $typeres;    
    /**
     * datedebutres
     *
     * @var mixed
     */
    private $datedebutres;    
    /**
     * datefinres
     *
     * @var mixed
     */
    private $datefinres;    
    /**
     * montantres
     *
     * @var mixed
     */
    private $montantres;    
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
     * ajoutsRessources
     *
     * @return void
     */
    public function ajoutsRessources()
    {
        if (isset($_POST['ressources'])) {
            $this->typeres = $_POST['restype'];
            $this->datedebutres = $_POST['datedebutres'];
            $this->datefinres = $_POST['datefinres'];
            $this->montantres = $_POST['montantres'];
            $this->lastid = $_SESSION['lastid'];

            $this->req = "INSERT INTO ressources (RES_Type, RES_DateDebut, RES_DateFin, RES_Montant, RES_Personnes_PER_id) VALUES (:typeres, :debutres,:finres,:montant,:lastid);";

            $this->dbh = new \App\Database();
            $this->dbh->prepareSql($this->req);
            $this->dbh->bindP(':typeres', $this->typeres, PDO::PARAM_STR);
            $this->dbh->bindV(':debutres', strftime("%Y-%m-%d", strtotime($this->datedebutres)), PDO::PARAM_STR);
            $this->dbh->bindP(':montant', $this->montantres, PDO::PARAM_INT);
            $this->dbh->bindV(':finres', strftime("%Y-%m-%d", strtotime($this->datefinres)), PDO::PARAM_STR);
            $this->dbh->bindP(':lastid', $this->lastid, PDO::PARAM_STR);
            $this->dbh->execReq();
            header('Location: /nuitees');
        }
        $chargeTwig = new \App\Twig('pages/ressources.html.twig');
        $chargeTwig->render([]);
        return  true;
    }
}
