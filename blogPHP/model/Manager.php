<?php

namespace OpenClassrooms\Blog\Model;

class Manager
{
    private $host = 'localhost';
    private $database = 'blogphp';
    private $user = 'root';
    private $pass = '';
    private $connexion;

    public function __construct($host=NULL, $database=NULL, $user=NULL, $pass=NULL) {
        if($host != NULL) {
            $this->host = $host;
            $this->database = $database;
            $this->user = $user;
            $this->pass = $pass;
        }
        try {
            $this->connexion = new \PDO('mysql:host='.$this->host.';dbname='.$this->database,
                $this->user,$this->pass, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING));
        }
        catch(\PDOException $e) {
            die('Erreur de connection');
        }
    }

    /**
     * @return \PDO
     */
    public function getConnexion(): \PDO
    {
        return $this->connexion;
    }
}