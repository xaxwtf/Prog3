<?php
class Venta{
    public $mailUser;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $hoy;
    public $nroPedido;
    public function __construct($mailUser,$sabor, $tipo, $cantidad){
        $this->hoy=date("Y-m-d H:i:s");
        $this->mailUser=$mailUser;
        $this->sabor=$sabor;
        $this->tipo=$tipo;
        $this->cantidad=$cantidad;
    }
    public function CrearVentaEnDb(){
        $r=false;
        $listaRecuperada=Helado::LeerListaGuardada("Helados.json");
        $i=0;
        foreach($listaRecuperada as $actual){

            if($actual->sabor==$this->sabor && $actual->tipo==$this->tipo ){
                if($actual->cantidad>=$this->cantidad){
                    $actual->cantidad= $actual->cantidad-$this->cantidad;
                    $objAccesoDatos = AccesoDatos::obtenerInstancia();
                    $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO ventas ( mail, sabor, tipo, cantidad, fecha, nroPedido) VALUES (:mail, :sabor, :tipo, :cantidad, :fecha, :nroPedido)");
                    $consulta->bindValue(':mail', $this->mailUser, PDO::PARAM_STR);
                    $consulta->bindValue(':sabor',$this->sabor, PDO::PARAM_STR);
                    $consulta->bindValue(':tipo',$this->tipo, PDO::PARAM_STR);
                    $consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_STR);
                    $consulta->bindValue(':fecha',$this->hoy, PDO::PARAM_STR);
                    $consulta->bindValue(':nroPedido',$this->nroPedido, PDO::PARAM_STR);
                    $consulta->execute();
                    $r=true;
                }
                else{
                    unset($listaRecuperada[$i]);
                }
                break;
            }
            $i++;
        }
        Helado::GuardarListaJson("Helados.json",$listaRecuperada);
        
        return $r;

    }
    public static function ObtenerSoloUserdeUnMail($mail):string 
    {
        $k;
        for($i=0;$i<strlen($mail);$i++){
            if($mail[$i] == '@'){
                $k=$i;
                break;
            }
        }
        return substr($mail,0,$k);
    }
}
?>