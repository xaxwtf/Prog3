<?php
include_once "./Helado.php";
include_once "./Venta.php";
include_once "./AccesoDatos.php";

$nuevo= new Venta($_POST["mail"], $_POST["sabor"], $_POST["tipo"], $_POST["cantidad"]);
$aux=Venta::ObtenerSoloUserdeUnMail($_POST["mail"]);
$destino = "./ImagenesDeLaVenta/" . $_POST["sabor"]. $_POST["tipo"] . $aux .".".$extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION); ;
var_dump($_FILES["imagen"]);
move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
if($nuevo->CrearVentaEnDb()){
    echo "CREADO CON EXITO CREO...";
}
else {
    echo "ERROR";
}
?>