<?php
include_once "Venta.php";
include_once "Archivos.php";
/*$nuevo=new Venta($_POST['mail'],$_POST['sabor'],$_POST['tipo'],$_POST['cantidad']);
$nuevo->AgregarImagen("img");
if($nuevo->AltaVenta()){
    echo "se vendio!";
    var_dump($nuevo);
}*/
$ventas=Archivos::LeerArchivoJson("Ventas.json");
var_dump($ventas);
?>