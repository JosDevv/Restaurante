<?php
include_once "app/model/db.class.php";
class Login extends BaseDeDatos {
    public function __construct()
    {
        //mando a llamar el constructor de la clase padre
        parent::conectar();
    }
    public function validarLogin($user,$pass)
    {
       //a la variable result se le asignara el valor de la consulta conexion es un objeto msqli
        $result=$this->conexion->query("SELECT * FROM `usuarios` WHERE `usuario`='$user' AND `password`=MD5('{$pass}')");
        return $result->fetch_assoc();
    }
}
?>