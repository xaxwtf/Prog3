<?php
include_once 'Pizza.php';
$lista=Pizza::LeerArchivoJson('Pizza.json');

$r= Pizza::BuscarPizzaEnLista($lista,$_POST["sabor"],$_POST["tipo"]);
if($r!=-1){
    echo "si hay";
}
else{
     echo "no existe!, una pizza con sabor:". $_POST["sabor"]. " y tipo: ". $_POST["tipo"];
}
?>