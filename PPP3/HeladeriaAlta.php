<?php
include_once "Helado.php";
include_once "Heladeria.php";

$nuevo= new Helado($_POST['sabor'],$_POST['precio'],$_POST['tipo'],$_POST['vaso'],$_POST['stock']);
$nuevo->AgregarImagen("img");
Heladeria::AgregarAListaJson($nuevo);
?>