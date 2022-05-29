<?php

namespace Models;

require_once('Models.php');

abstract class Commentaires extends Models {
    
    public function __construct()
    {
        parent::__construct('commentaires');
    }
    
}
