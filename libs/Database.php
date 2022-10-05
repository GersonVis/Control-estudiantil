<?php
class Database{
    private $host;
    private $user;
    private $password;
    private $db;
    function __construct()
    {
        $this->host=constant('HOST');
        $this->user=constant('USER');
        $this->password=constant('PASSWORD');
        $this->db=constant('DB');
    }
    function conectar(){

    }
}

?>

