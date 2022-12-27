<?php
include_once "app/model/login.php";
    class LoginController extends Controller {
        private $user;
        public function __construct($param){
            $this->user=new Login();
            parent::__construct("Login",$param);
            
         }
         //funcion para validar el usuario
        public function validar()
        {
            //optengo los valores que envia mi formulario en caso de no haberlos los asigno vacios
            $u=$_POST["nombre"] ?? "";
            $p=$_POST["pass"] ?? "";
         
            //en el caso que los valores coincidan en mi base de datos entro en la condicion
            if ($record=$this->user->validarLogin($u,$p)) {
               //pregunto si la variable $_session existe si no existe la creo  
               if(!isset($_SESSION)){
                session_start();
               }
               //asigno los valores optenidos de la consulta a la variable $_SESSION
               
               $_SESSION["id_usr"]=$record["idusuario"];
               $_SESSION["id_tipo"]=$record["tipo"];
               $_SESSION["usuario"]=$record["usuario"];
               $_SESSION["nuser"]="{$record['nombres']} {$record['apellidos']}";
               //valido si el usuario es admin o normal y lo redirecciono a diferentes Dashboard
               if ($record["tipo"]==1) {
                $info=array("success"=>true,"msg"=>"Usuario Correcto","link"=>URL."Dashboard");
               }else{
                $info=array("success"=>true,"msg"=>"Usuario Correcto","link"=>URL."Dashboarduser");
               }
            //en caso de que no exista lo informo
            }else{
                $info=array("success"=>false,"msg"=>"Usuario no Existe");
            }
            
            echo json_encode($info);
        }
        //funcion para destruir  la variable session y redireccionar a Login.php
        public function cerrar()
        {
            if(!isset($_SESSION)){
                session_start();
               }
               session_destroy();
               $this->view->Render("Login"); 
        }
    }
    
?>