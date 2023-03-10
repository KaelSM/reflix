<?php

    class SeasonProvider {
        private $con, $username;

        public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
        }

        public function create($entity){
            
        }
    
    }

?>