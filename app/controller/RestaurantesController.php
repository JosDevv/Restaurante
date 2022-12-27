<?php
include_once "app/model/restaurantes.php";
    class RestaurantesController extends Controller {
        private $user;
        public function __construct($param){
            $this->user=new Usuarios();
            parent::__construct("Restaurantes",$param,true);
            
         }

}