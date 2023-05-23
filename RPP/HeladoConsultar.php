<?php
include_once "./Helado.php";

$r= Helado::ValidarSaborYtipo($_GET['tipo'],$_GET['sabor']);

$respuesta= "no existe el Helado sabor ".$_GET['sabor'] . "y tipo". $_GET['tipo'];
if($r["sabor"]&& $r["tipo"]){
    $respuesta= "existe!!!";
}
if(!$r["sabor"]&& $r["tipo"]){
    $respuesta= "el sabor ". $_GET["sabor"]. " no existe";
}
if(!$r["sabor"]&& !$r["tipo"]){
    $respuesta= "el tipo ". $_GET["tipo"]. " no existe";
}

echo $respuesta;

?>