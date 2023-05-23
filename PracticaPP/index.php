<?php

if($_SERVER['REQUEST_METHOD']=="POST")
{
        switch($_GET['accion']){
            case "AltaVenta":
                require_once 'AltaVenta.php';
                break;
            case "PizzaConsultar":
                require_once 'PizzaConsultar.php';
                break;
        }
        
}
else if(['REQUEST_METHOD']=="GET"){
        require_once 'PizzaCarga.php';
}
