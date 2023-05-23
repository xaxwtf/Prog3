<?php
include_once "Helado.php";
include_once "Archivos.php";
class Heladeria{

    public static function AgregarAListaJson($dato){
        $r=false;
        $datos=Archivos::LeerArchivoJson("Heladeria.json");
           
        $index=Heladeria::BuscarHeladoEnLista($datos,$dato->sabor,$dato->tipo);
        if($index!=-1)
        {
            $datos[$index]->precio=$dato->precio;
            $datos[$index]->stock=$datos[$index]->stock+$dato->stock;
        }
        else{
            $dato->GuardarUltimoId();
            $datos[count($datos)]=$dato;
        }
        
        Archivos::EscribirArchivoJson("Heladeria.json",$datos);
        $r=true;
        return $r;
    }
    public static function BuscarHeladoEnLista($lista,$sabor,$tipo){
        $r= -1;
        for($i=0;$i<count($lista);$i++){
            if($lista[$i]->sabor==$sabor && $lista[$i]->tipo == $tipo)
            {
                $r=$i;
                break;
            }
        }
        return $r;
    }
}

?>