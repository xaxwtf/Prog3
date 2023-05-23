<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
    switch($_GET['accion']){
      case "HeladeriaAlta":
        require_once "HeladeriaAlta.php";
        break;
      case "HeladoConsultar":
        require_once "HeladoConsultar.php";
        break;
      case "AltaVenta":
        require_once "AltaVenta.php";
        break;
    }
    
        
}
else if(['REQUEST_METHOD']=="GET"){
  include_once "ConsultasVentas.php";
  
}
    
?>