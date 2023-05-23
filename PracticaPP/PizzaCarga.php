<?php
include_once "Pizza.php";

$nuevo = new Pizza($_GET["sabor"],$_GET["precio"],$_GET["tipo"],$_GET["cantidad"]);
Pizza::AgregarAListaJson("Pizza.json", $nuevo);

//$r=Pizza::LeerArchivoJson("Pizza.json");
//var_dump($r);
//echo $r[0]->id;
?>