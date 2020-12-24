<?php

namespace App;

use \PDO;

class Database
{
    
    /**
     * db_name
     *
     * @var mixed
     */  
    private $db_name;    
    /**
     * db_user
     *
     * @var mixed
     */
    private $db_user;    
    /**
     * db_pass
     *
     * @var mixed
     */
    private $db_pass;    
    /**
     * db_host
     *
     * @var mixed
     */
    private $db_host;    
    /**
     * statement
     *
     * @var mixed
     */
    private $statement;    
    /**
     * pdo
     *
     * @var mixed
     */
    private $pdo;    
    /**
     * datas
     *
     * @var mixed
     */
    private $datas;    
    /**
     * __construct
     *
     * @param  mixed $db_name
     * @param  mixed $db_user
     * @param  mixed $db_pass
     * @param  mixed $db_host
     * @return void
     */
    public function __construct($db_name = DBNAME, $db_user = USER, $db_pass = PASS, $db_host = HOST)
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
        
        $this->pdo = null;
        $this->getPDO();
    }
    
    /**
     * getPDO
     *
     * @return void
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO('mysql:host=' . $this->db_host . ';port=' . PORT . ';dbname=' . $this->db_name, $this->db_user, $this->db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }
    
    /**
     * query
     *
     * @param  mixed $statement
     * @return void
     */
    public function query($statement)
    {
        $req = $this->pdo->prepare($statement);
        $req->execute();
        $this->datas = $req->fetchAll(PDO::FETCH_OBJ);
        return $this->datas;
    }    
    /**
     * prepareSql
     *
     * @param  mixed $sql
     * @return void
     */
    public function prepareSql($sql)
    {


        $this->statement = $this->pdo->prepare($sql);
    }    
    /**
     * bindP
     *
     * @param  mixed $cursor
     * @param  mixed $value
     * @param  mixed $typeParam
     * @return void
     */
    public function bindP($cursor, $value, $typeParam)
    {

        $this->statement->bindParam($cursor, $value, $typeParam);
    }    
    /**
     * bindV
     *
     * @param  mixed $cursor
     * @param  mixed $value
     * @param  mixed $typeParam
     * @return void
     */
    public function bindV($cursor, $value, $typeParam)
    {

        $this->statement->bindValue($cursor, $value, $typeParam);
    }    
    /**
     * execReq
     *
     * @return void
     */
    public function execReq()
    {

        $this->statement->execute();
    }    
    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {

        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * getOne
     *
     * @return void
     */
    public function getOne()
    {

        return $this->statement->fetch(PDO::FETCH_OBJ);
    }    
    /**
     * lastId
     *
     * @return void
     */
    public function lastId()
    {

        return $this->pdo->lastInsertId();
    }
}
