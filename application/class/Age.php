<?php

namespace App;


use \PDO;

class Age
{
    private $sql;

    public function insererAge()
    {
        $this->sql = "UPDATE `personnes` SET PER_Age = TIMESTAMPDIFF(YEAR,PER_DateNaissance,CURDATE()) ORDER BY PER_id DESC;";
        $this->dbh = new \App\Database();
        $this->dbh->prepareSql($this->sql);
        $this->dbh->execReq();
    }
}
