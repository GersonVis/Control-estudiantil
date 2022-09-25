<?php
class Model{
    function __construct()
    {
     
    }
    function renderizar($vista){
        include_once "views/$vista.php";
    }
 }

?>