<?php
include_once "Archivos.php";
include_once "Heladeria.php";
$lista=Archivos::LeerArchivoJson('Heladeria.json');

$r= Heladeria::BuscarHeladoEnLista($lista,$_POST["sabor"],$_POST["tipo"]);
if($r!=-1){
    echo "si hay";
}
else{
     echo "no existe!, un Helado con sabor:". $_POST["sabor"]. " y tipo: ". $_POST["tipo"];
}
?>