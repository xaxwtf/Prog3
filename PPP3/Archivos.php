<?php
class Archivos{
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
   
}


?>