<?php 

namespace Models;

use \PDO;
use \PDOException;

if(!isset($_SESSION))
session_start();





abstract class Models{

    private static $dbName = "blogv2";
    private static $dbHost = "localhost";
    private static $dbUsername = "root";
    private static $dbPassword = "";
    protected static $bdd = null;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }


    static function getBdd(): PDO
    {
        if (static::$bdd == NULL) {
            try {
                static::$bdd = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbPassword, [
                    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
?>
                <h1 class='bg-danger text-center'>La connexion à échouée<h1>
                        <h3 class='bg-warning'>Le message d'erreur : <?php $e->getMessage()  ?> "</h3>"
        <?php
            }
        } // fin du if
        return static::$bdd;
    }

        public function selectAll() : array {
            $sql = "SELECT * FROM $this->table";
            $query = static::getBdd()->prepare($sql);
            $query->execute();
            // var_dump($query);
            $data = $query->fetchAll();
            return $data;
            
        }

        public function selectLast() : array {
            $sql = "SELECT * FROM $this->table ORDER BY DESC LIMIT 4";
            $query = static::getBdd()->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();
            return $data;
        }

        public function delete($id) : void {
            $sql = "DELETE FROM utilisateurs WHERE utilisateurs.id = :id";
            $query = static::getBdd()->prepare($sql);
            $query->execute([
                'id' => $id
            ]);

        }
    
}