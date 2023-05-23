<?php
include_once "Helado.php";
include_once "Heladeria.php";
include_once "Archivos.php";
class Venta{
    public $id;
    public $mail;
    public $sabor;
    public $tipo;
    public $stock;
    public $image;
    public $fecha;
    
    public function __construct(string $mail, $sabor, $tipo, $stock){
        $this->mail=$mail;
        $this->sabor=$sabor;
        $this->tipo=$tipo;
        $this->stock=$stock;
        $this->fecha= date("Ymd");         
        $this->id=$this->LeerUltimoId() + 1;
    }
    public function AltaVenta(){
        $r=false;
        $ventas=[];
        if(file_exists("Ventas.json")){
            $ventas=Archivos::leerArchivoJson("Ventas.json");
        }
        $helados= Archivos::LeerArchivoJson("Heladeria.json");
        $index=Heladeria::BuscarHeladoEnLista($helados,$this->sabor,$this->tipo);
        if($index!= -1){
            $helados[$index]->stock=$helados[$index]->stock -  $this->stock;

            $this->AgregarImagen($helados[$index]->image);
            ///copiar la imagen de helado!
            Archivos::EscribirArchivoJson("Heladeria.json",$helados);
            $ventas[count($ventas)]=$this;
            Archivos::EscribirArchivoJson("Ventas.json",$ventas);
            $this->GuardarUltimoId();
            $r=true;
        }
        return $r;
    }
    public function AgregarAListaJson($archivo){
        $datos=Archivos::LeerArchivoJson($archivo);
        $datos[count($datos)]=$this;
        Archivos::EscribirArchivoJson($archivo,$datos);
    }
    public function EditarDeListaJson($archivo, $dato){
        $datos=Archivos::LeerArchivoJson($archivo);
        for($i=0;$i<count($datos);$i++){
            if(false);
        }
    }
    public function EliminarDeListaJson($archivo, $dato){

    }
    private function ObtenerMailSinArroba(){
        $resultado="";
        var_dump($this->mail);
        for($i=0;$i<strlen($this->mail);$i++){
            if($this->mail[$i]=='@'){
                $resultado=substr($this->mail,0,$i);
                break;
            }
        }
        return $resultado;
    }
    private function GuardarUltimoId(){    
        $nombre="idVenta.txt";   
        $archivo = fopen($nombre,"w");
        fwrite($archivo, $this->id);
        fclose($archivo);  
    }
    private function LeerUltimoId(){
        $resultado=0;
        $name="idVenta.txt";
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
    public function AgregarImagen($origen){
       
        $info = new SplFileInfo($origen);
        $destino = "ImagenesDeLaVenta/2023/" .$this->tipo . $this->sabor . $this->ObtenerMailSinArroba() . $this->fecha .".". $info->getExtension();
        copy($origen, $destino);
        $this->image=$destino;
    }
    ///informes!!
    public static function CantidadDeHeladosVendidosxdia($dia=null){
        $contador=0;
        $ventas=Archivo::leerArchivoJson("Ventas.json");
        $d;
        if($dia==null){
            $d=strtotime('-1 day'); 
        }
        else{
            $d=strtotime($dia); 
        }
        for($i=0;$i<count($ventas);$i++){
            if(strtotime($ventas[$i]->fecha) ==$d){
                    $contador=$ventas[$i]->stock+$contador;
            }
        }
        return $contador;
    }
    public static function PizzasVendidasDeFechaAFecha($f1,$f2){
        $a=strtotime($f1);
        $b=strtotime($f2);
        $ventas=Archivos::LeerArchivoJson("Ventas.json");
        for($i=0;$i<count($ventas);$i++){
            if(strtotime($ventas[$i]->fecha)>=$a && strtotime($ventas[$i]->fecha)<=$b){
                
            }
        }
    }
}
?>
