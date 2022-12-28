<?php
include_once "app/model/db.class.php";
class Productos extends BaseDeDatos {
    public function __construct()
    {
        parent::conectar();
    }

    public function getAllProductos()
    {
       return $this->executeQuery("SELECT productos.*, restaurantes.nombre_restaurante AS nombre_restaurante FROM productos INNER JOIN restaurantes ON restaurantes.idrestaurante = productos.idrestarutante");        
    }

    public function getAllRestaurantes(Type $var = null)
    {
        return $this->executeQuery("SELECT * FROM `restaurantes` WHERE 1");  
    }

    public function getProductosByName($name)
    {
        return $this->executeQuery("SELECT * FROM `productos` WHERE `nombre`='{$name}'");        
     
    }
    public function getProductoBynameAndId($name,$id)
    {
        return $this->executeQuery("SELECT * FROM `productos` WHERE `nombre`='{$name}' AND `idproducto`<>'{$id}'");        
     
    }

    public function save($data,$imgp,$imgm,$imgg)
    {
        return $this->executeInsert("INSERT INTO `productos` SET `idrestarutante`='{$data['restauranteid']}',`nombre`='{$data['nombre']}',`descripcion`='{$data['descripcion']}',`foto1`='{$imgp}',`foto2`='{$imgm}',`foto3`='{$imgg}',`precio`=CAST('{$data['precio']}' AS DECIMAL)");
    }

    public function getOneProducto($id)
    {
        return $this->executeQuery("SELECT productos.*, restaurantes.nombre_restaurante AS nombre_restaurante FROM productos INNER JOIN restaurantes ON restaurantes.idrestaurante = productos.idrestarutante WHERE productos.idproducto = '{$id}'");        
    
    }
    public function update($data,$imgp=NULL,$imgm,$imgg)
    { 
        return $this->executeUpdate("UPDATE `productos` SET `idrestarutante`='{$data['restauranteid']}',`nombre`='{$data['nombre']}',`descripcion`='{$data['descripcion']}',`foto1`=if('{$imgp}'='',`foto1`,'{$imgp}'),`foto2`=if('{$imgm}'='',`foto2`,'{$imgm}'),`foto3`=if('{$imgg}'='',`foto3`,'{$imgg}'),`precio`=CAST('{$data['precio']}' AS DECIMAL) WHERE `idproducto` = '{$data['idproducto']}'");
    }
    public function deleteProductos($id)
    {
        return $this->executeUpdate("DELETE FROM `productos` WHERE `idproducto`='{$id}'");
    }

    public function saveI($data)
    {
        return $this->executeInsert("INSERT INTO `ingredientes`(`idproducto`, `descripcion`, `costo_adicional`) VALUES ('{$data['idingrediente']}','{$data['descripcion']}',CAST('{$data['costo']}' AS DECIMAL))");
    }
//CAST('{$data['precio']}' AS DECIMAL)
}
?> 