<?php
include_once "app/model/restaurantes.php";
    class MainController extends Controller {
        private $restaurante;
        public function __construct($param){
            $this->restaurante=new Restaurante();
           parent::__construct("Main",$param);
        }

        
        
        public function getAllRestaurantes()
        {
            $records=$this->restaurante->getAllRestaurantes();
            $info=array('success'=> true,'records'=>$records);
            echo json_encode($info);
        }
    }
    
?>