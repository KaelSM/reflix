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
        $this->validateEmail($em, $em2);

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

    private function validateEmail ($em, $em2)
    {
        if ($em != $em2){
            array_push($this->errorArray, Constants::$emailError);
            return;
        }
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)){ //The fuilder would return false if is a false email
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=em");
        $query->bindValue(":em", $em); //same as bind param but lets you use a value

        $query->execute();
        if ($query->rowCount() != 0)
        {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePwd ($pw, $pw2){
        if ($pw != $pw2){
            array_push($this->errorArray, Constants::$pwError);
            return;
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return $error;
        }
    }

}
?>