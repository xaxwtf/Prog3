<?php
class Usuario{
    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $localidad;
    
    /*public function  __construct($nombre, $apellido ,$clave ,$mail, $localidad, $id){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->clave=$clave;
        $this->mail=$mail;
        $this->localidad=$localidad;
    }*/

    public static function  ConsultarUsuariosDB(){
        $conStr = "mysql:host=localhost; dbname=utn_test";
        $pdo = new PDO($conStr, "root", "");
        $sentence= $pdo->prepare("SELECT id, nombre, apellido, clave, mail, localidad FROM usuarios");
        $sentence->execute();
    
        $resultado= $sentence->fetchAll();
        
        var_dump($resultado);
    }

}


Usuario::ConsultarUsuariosDB();

?>