<?php
class Account {

    private $con;
    private $errorArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
        $this->validateName($fn);
        $this->validateName($ln);
        $this->validateUserName($un);
    }

    private function validateName($passedName) {
        if(strlen($passedName) < 2 || strlen($passedName) > 25) {
            array_push($this->errorArray, Constants::$nameCharacters);
        }
    }

    private function validateUserName($un) {
        if(strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$userCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=un");
        $query->bindValue(":un", $un); //same as bind param but lets you use a value

        $query->execute();
        if ($query->rowCount() != 0)
        {
            array_push($this->errorArray, Constants::$userNameTaken);
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return $error;
        }
    }

}
?>