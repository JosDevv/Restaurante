<?php
include_once "app/model/restaurantes.php";
    class RestaurantesController extends Controller {
        private $restaurante;
        public function __construct($param){
            $this->restaurante=new Restaurante();
            parent::__construct("Restaurantes",$param,true);
            
         }

         public function getAllRestaurantes()
        {
            $records=$this->restaurante->getAllRestaurantes();
            $info=array('success'=> true,'records'=>$records);
            echo json_encode($info);
        }

        public function save()
        {
            $img="";
            if (isset($_FILES["foto"])) {
                if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                    if (($_FILES["foto"]["type"]=="image/png") || ($_FILES["foto"]["type"]=="image/jpeg")) {
                        
                        copy($_FILES["foto"]["tmp_name"],__DIR__."/../../public_html/fotos/".$_FILES["foto"]["name"]) or die("No se pudo guardar Archivo");
                        $img=URL."public_html/fotos/".$_FILES["foto"]["name"];
                    }else{
                        $img="";
                    }
                    
                }
                if ($_POST["idrestaurante"]==0) {
                    
                    if(count($this->restaurante->getrestauranteByname($_POST["nombre_restaurante"]))>0){
                        
                        $info=array('success'=>false,'msg'=>"Restaurante existente");
                    }else{
                        $records=$this->restaurante->save($_POST,$img);
                        $info=array('success'=>true,'msg'=>"Restaurante guardado");
                    }
    
    
                }else{
                    
                    if(count($this->restaurante->getrestauranteBynameAndId($_POST["nombre_restaurante"],$_POST["idrestaurante"]))>1){
                        
                        $info=array('success'=>false,'msg'=>"Restaurante no existente");
                    }else{

                        $records=$this->restaurante->update($_POST,$img);
                        $info=array('success'=>true,'msg'=>"Restaurante guardado");
                    }

                }
                echo json_encode($info);
            }
        }

        public function getOneRestaurante()
        {
            
            $records=$this->restaurante->getOneRestaurante($_GET["id"]);
            if (count($records)>0) {
                $info=array('success'=>true,'records'=>$records);
            }else {
                $info=array('success'=>false,'msg'=>"Restaurante no existe");
            }
            echo json_encode($info);
        }

        public function deleteRestaurante()
        {
            
            $records=$this->restaurante->deleteRestaurante($_GET["id"]);
            $info=array('success'=>true, 'msg'=>"Restaurante eliminado");
            echo json_encode($info);
        }

}