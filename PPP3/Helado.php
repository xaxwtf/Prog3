<?php
include_once "Archivos.php";
class Helado{
    public $id;
    public $sabor;
    public $precio;
    public $tipo;
    public $vaso;
    public $stock;
    public $image;
    
    public function __construct($_sabor,$_precio, $_tipo, $_vaso, $_stock){
        $this->id=$this->LeerUltimoId()+1;
        $this->sabor=$_sabor;
        $this->tipo=$_tipo;
        $this->stock=$_stock;
        $this->precio=$_precio;
        $this->vaso=$_vaso;
    }
    public function GuardarUltimoId(){    
        $nombre="idHelado.txt";   
        $archivo = fopen($nombre,"w");
        fwrite($archivo, $this->id);
        fclose($archivo);  
    }
    private function LeerUltimoId(){
        $resultado=0;
        $name="idHelado.txt";
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
        $destino = "ImagenesDeHelados/2023/" . $this->tipo ."-". $this->sabor .".". $info->getExtension();
        $resultado=move_uploaded_file($_FILES[$referencia]["tmp_name"], $destino);
        $this->image=$destino;
    }
}
?>