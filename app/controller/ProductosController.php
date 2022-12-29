<?php
include_once "app/model/productos.php";
    class ProductosController extends Controller {
        private $productos;
        public function __construct($param){
            $this->productos=new Productos();
            parent::__construct("Productos",$param,true);
            
         }
        //optener todos los productos
         public function getAllProductos()
        {
            $records=$this->productos->getAllProductos();
            $info=array('success'=> true,'records'=>$records);
            echo json_encode($info);
        }
        //optiene un producto dependiendo del id
        public function getOneProductos()
        {
            $records=$this->productos->getOneProducto($_GET["id"]);
            if (count($records)>0) {
                $info=array('success'=>true,'records'=>$records);
            }else {
                $info=array('success'=>false,'msg'=>"Producto no existe");
            }
            echo json_encode($info);
        }

        //funcion para guardar un producto
        public function save()  
        {
            //retorna una cadena vacia si no se a seteado una foto 
            $imgp = $this->productos->guardarFoto("fotop");
            $imgm = $this->productos->guardarFoto("fotom");
            $imgg = $this->productos->guardarFoto("fotog");
            
            if ($_POST["idproducto"]==0) {
                    
                if(count($this->productos->getProductosByName($_POST["nombre"]))>0){
                    
                    $info=array('success'=>false,'msg'=>"Producto existente");
                }else{
                    $records=$this->productos->save($_POST,$imgp,$imgm,$imgg);
                    $info=array('success'=>true,'msg'=>"Producto guardado");
                }


            }else{
                
                if(count($this->productos->getProductoBynameAndId($_POST["nombre"],$_POST["idproducto"]))>1){
                    
                    $info=array('success'=>false,'msg'=>"Producto no existente");
                }else{
                    $records=$this->productos->update($_POST,$imgp,$imgm,$imgg);
                    $info=array('success'=>true,'msg'=>"Producto guardado");
                }

            }
            
            echo json_encode($info);
            
        }
        //funcion para eliminar un producto
        public function deleteProductos()
        {
            
            $records=$this->productos->deleteProductos($_GET["id"]);
            $info=array('success'=>true, 'msg'=>"Restaurante eliminado");
            echo json_encode($info);
        }
        //funcion para guardar un ingrediente teniendo como base el id del producto
        public function saveI()  
        {
            $records=$this->productos->saveI($_POST);
            $info=array('success'=>true,'msg'=>"Ingrediente guardado");
                     
            echo json_encode($info);
            
        }
}
?>
