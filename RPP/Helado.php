<?php
class Helado{
        public $id;
        public $sabor;
        public $tipo;
        public $cantidad;
        public $precio;
        public function __construct($_id,$_sabor,$_tipo,$_cantidad,$_precio){
            $this->id=$_id;
            $this->sabor=$_sabor;
            $this->tipo=$_tipo;
            $this->cantidad=$_cantidad;
            $this->precio=$_precio;
        }


        public static function GuardarListaJson($nombreArchivo,$lista)
        {
            $formatoJson = json_encode($lista);
            
            try{
                $archivo = fopen($nombreArchivo,"w");
                if(isset($archivo)){
                    echo fwrite($archivo,$formatoJson);
                }
                fclose($archivo);
            }
            catch(e){
                echo e;
            }
        }
        public static function LeerListaGuardada($nombreArchivo){
            $aux=fopen($nombreArchivo,"r");
            if(isset($aux)){
                $listaRecuperada=json_decode(fread($aux, filesize($nombreArchivo)));
            }
            fclose($aux);
            return $listaRecuperada;
        }
        
        public static function  ValidarSaborYtipo($tipo, $sabor)
        {   
            $resultados=array("sabor"=>false, "tipo"=>false);
            $miLista = Helado::LeerListaGuardada("Helados.json");
            foreach($miLista as $actual){
        
                if($actual->sabor == $sabor  ){
                    $resultados["sabor"]=true;
                }
                if($actual->tipo == $tipo ){
                    $resultados["tipo"]=true;
                }
            }
            return $resultados;
        }
    }
?>