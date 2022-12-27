<?php
include_once "app/model/usuarios.php";
    class UsuariosController extends Controller {
        private $user;
        public function __construct($param){
            $this->user=new Usuarios();
            parent::__construct("Usuarios",$param,true);
            
         }
        public function getAll()
        {
            $records=$this->user->getAll();
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
                if ($_POST["id_usr"]==0) {
                    
                    if(count($this->user->getUserByname($_POST["usuario"]))>0){
                        
                        $info=array('success'=>false,'msg'=>"usuario existente");
                    }else{
                        $records=$this->user->save($_POST,$img);
                        $info=array('success'=>true,'msg'=>"usuario guardado");
                    }
    
    
                }else{
                    if(count($this->user->getUserBynameAndId($_POST["usuario"],$_POST["idusuario"]))>1){
                        
                        $info=array('success'=>false,'msg'=>"usuario existente");
                    }else{
                        $records=$this->user->update($_POST,$img);
                        $info=array('success'=>true,'msg'=>"usuario guardado");
                    }

                }
                echo json_encode($info);
            }
        }

        public function getOneUser()
        {
            $records=$this->user->getOneUser($_GET["id"]);
            if (count($records)>0) {
                $info=array('success'=>true,'records'=>$records);
            }else {
                $info=array('success'=>false,'msg'=>"usuario no existe");
            }
            echo json_encode($info);
        }

        public function deleteUser()
        {
            
            $records=$this->user->deleteUser($_GET["id"]);
            $info=array('success'=>true, 'msg'=>"usuario eliminado");
            echo json_encode($info);
        }
    }

?>