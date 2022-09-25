<?php
class View{
    function __construct()
    {
     
    }
    function renderizar($vista){
        include_once "views/$vista.php";
    }
 }

?>