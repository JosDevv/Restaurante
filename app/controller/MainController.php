<?php
    class MainController extends Controller {
        public function __construct($param){
           parent::__construct("Main",$param);
        }

        public function menu(){
            echo "menu";
        }
    }
    
?>