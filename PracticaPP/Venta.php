<?php
include_once "Pizza.php";
include_once "Archivos.php";
class Venta{
    public $id;
    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $image;
    public $fecha;
    
    public function __construct(string $mail, $sabor, $tipo, $cantidad){
        $this->mail=$mail;
        $this->sabor=$sabor;
        $this->tipo=$tipo;
        $this->cantidad=$cantidad;
        $this->fecha= date("Ymd");         
        $this->id=$this->LeerUltimoId() + 1;
    }
    public function AltaVenta(){
        $r=false;
        $ventas=[];
        if(file_exists("Ventas.json")){
            $ventas=Archivos::leerArchivoJson("Ventas.json");
        }
        $pizzas= Archivos::LeerArchivoJson("Pizza.json");
        $index=Pizza::BuscarPizzaEnLista($pizzas,$this->sabor,$this->tipo);
        if($index!= -1){
            $pizzas[$index]->cantidad=$pizzas[$index]->cantidad- $this->cantidad;
            Archivos::EscribirArchivoJson("Pizza.json",$pizzas);
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
    public function AgregarImagen($referencia){

        $info = new SplFileInfo($_FILES[$referencia]["name"]);
        $destino = "ImagenesDeLaVenta/" .$this->tipo . $this->sabor . $this->ObtenerMailSinArroba() . $this->fecha .".". $info->getExtension();
        $resultado=move_uploaded_file($_FILES[$referencia]["tmp_name"], $destino);
        $this->image=$destino;
    }
    ///informes!!
    public static function CantidadDePizzasVendidas(){
        $contador=0;
        $ventas=Archivo::leerArchivoJson("Ventas.json");
        for($i=0;$i<count($ventas);$i++){
            $contador=$ventas[$i]->cantidad+$contador;
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
