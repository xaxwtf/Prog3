<?php
include_once "Ventas.php";

$resultado=Ventas::CantidadDeHeladosVendidosxdia($_GET['dia']);
echo $resultado;

?>