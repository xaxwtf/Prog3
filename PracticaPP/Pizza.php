<?php
class Pizza {
    public $id;
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;

    public function __construct($sabor, $precio, $tipo, $cantidad){
        $this->id= $this->LeerUltimoId() + 1;
        $this->sabor= $sabor;
        $this->precio= $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
    }
    private function GuardarUltimoId(){    
        $nombre="idPizza.txt";   
        $archivo = fopen($nombre,"w");
        fwrite($archivo, $this->id);
        fclose($archivo);  
    }
    private function LeerUltimoId(){
        $resultado=0;
        $name="idPizza.txt";
        if(file_exists($name)){
            try{
                $archivo = fopen($name,"r");
                if($archivo){
                    $resultado = fread($archivo, filesize($name));
                    fclose($archivo);
                }  
            }
            catch(e){
            }
        }
        return $resultado;
    }
    public static function AgregarAListaJson($nameList,$dato){
        $datos=Pizza::LeerArchivoJson($nameList);
        ///verificacion de existencia!
        $existe=false;
        for($i=0;$i<count($datos);$i++){
            if($datos[$i]->sabor==$dato->sabor && $datos[$i]->tipo == $dato->tipo)
            {
                $existe=true;
                $datos[$i]->precio=$dato->precio;
                $datos[$i]->cantidad=$datos[$i]->cantidad+$dato->cantidad;
                break;
            }
        }
        if(!$existe){
            $dato->GuardarUltimoId();
            $datos[count($datos)]=$dato;
        }
    
        Pizza::EscribirArchivoJson($nameList,$datos);
        ///pasando a json!!
        /*$datosFJson=json_encode($datos); 

        $archivo = fopen($nameList,"w");
        echo fwrite($archivo,$datosFJson);
        fclose($archivo);*/
    }
    public static function EscribirArchivoJson($nombre,$datos){
        $datosFJson=json_encode($datos); 
        $archivo = fopen($nombre,"w");
        echo fwrite($archivo,$datosFJson);
        fclose($archivo);
    }
    public static function LeerArchivoJson($nombre){
        $r=[];
        if(file_exists($nombre)){
            try{
                $archivo = fopen($nombre,"r");
                if($archivo){
                    $formatoJson = fread($archivo, filesize($nombre));
                    
                    $r=json_decode($formatoJson);
                    fclose($archivo);
                }
            }
            catch(e){
            }
        }
        return $r;
    }
    public static function BuscarPizzaEnLista($lista,$sabor,$tipo){
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