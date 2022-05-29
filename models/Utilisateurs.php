<?php

namespace Models;

require_once('Models.php');

 class Utilisateurs extends Models {

    public function __construct()
    {
        parent::__construct('Utilisateurs');
    }

    public function connectAdmin($id){
    
        $sql = "SELECT droit FROM utilisateurs WHERE utilisateurs.id = :id ";
        $query = parent::getBdd()->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        $data = $query->fetch();
        $userDroit = $data['droit'];
        // var_dump($userDroit);

        if($userDroit !== 'admin') echo "pas admin";
        else return true;

        

        
    }
    
    public function connect(){

    }

}


$obj = new Utilisateurs;

// $obj->connectAdmin(2);

// var_dump($obj->selectAll());
