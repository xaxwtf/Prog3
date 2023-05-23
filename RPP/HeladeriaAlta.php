<?php
    include_once "./Helado.php";
    
    $nuevo = new Helado($_SESSION['count'],$_POST["sabor"],$_POST["tipo"],$_POST["cantidad"],$_POST["precio"]);
    $nameFile="Helados.json";
    $lista;
    $listaRecuperada;
    if(!file_exists($nameFile)){
        $lista[0]=$nuevo;
    }
    else{
        $listaRecuperada=Helado::LeerListaGuardada($nameFile);
        $noexiste=true;
        foreach($listaRecuperada as $actual){
            if($actual->sabor==$nuevo->sabor && $actual->tipo==$nuevo->tipo){
                $actual->precio=$nuevo->precio;
                $actual->cantidad= $actual->cantidad+$nuevo->cantidad;
                $noexiste=false;
                break;
            }
        }
        $lista=$listaRecuperada;
        if($noexiste){
            $lista[count($listaRecuperada)]=$nuevo;
        }
    }
    $destino = "./ImagenesDeHelados/".$_FILES["imagen"]["name"];
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
    Helado::GuardarListaJson("Helados.json",$lista);

?>