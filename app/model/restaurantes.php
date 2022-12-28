<?php
include_once "app/model/db.class.php";
class Restaurante extends BaseDeDatos {
    public function __construct()
    {
        parent::conectar();
    }
    public function getAllRestaurantes()
    {
       return $this->executeQuery("SELECT * FROM `restaurantes` WHERE 1");        
    }

    public function getrestauranteByname($name)
    {
        return $this->executeQuery("SELECT * FROM `restaurantes` WHERE `nombre_restaurante`='{$name}'");        
     
    }
    public function save($data,$img)
    {
        return $this->executeInsert("INSERT INTO `restaurantes` ( `nombre_restaurante`, `direccion`, `telefono`, `contacto`, `foto`, `fecha_ingreso`, `latitud`, `longitud`) VALUES ('{$data["nombre_restaurante"]}', '{$data["direccion"]}', '{$data["telefono"]}', '{$data["contacto"]}', '{$data["foto"]}', '{$data["fecha"]}', '{$data["latitud"]}', '{$data["longitud"]}')");    
    }

    public function getOneRestaurante($id)
    {
        return $this->executeQuery("SELECT * FROM `restaurantes` WHERE `idrestaurante`='{$id}'");
    }

    public function getrestauranteBynameAndId($name,$id)
    {
        return $this->executeQuery("SELECT * FROM `restaurantes` WHERE `nombre_restaurante`='{$name}' AND `idrestaurante` <>'{$id}'");        
     
    }

    public function update($data,$img)
    { 
        return $this->executeUpdate("UPDATE `restaurantes` SET `nombre_restaurante`='{$data["nombre_restaurante"]}',`direccion`='{$data["direccion"]}',`telefono`='{$data["telefono"]}',`contacto`='{$data["contacto"]}',`foto`=if('{$img}'='',foto,'{$img}'),`fecha_ingreso`='{$data["fecha"]}',`latitud`='{$data["latitud"]}',`longitud`='{$data["longitud"]}' WHERE `idrestaurante`='{$data["idrestaurante"]}'");
    }

    public function deleteRestaurante($id)
    {
        return $this->executeUpdate("DELETE FROM `restaurantes` WHERE `idrestaurante`='{$id}'");
    }

}
//return $this->executeInsert("INSERT INTO `restaurantes` (`idrestaurante`, `nombre_restaurante`, `direccion`, `telefono`, `contacto`, `foto`, `fecha_ingreso`, `latitud`, `longitud`) VALUES ('{$data["idrestaurante"]}', '{$data["nombre_restaurante"]}', '{$data["direccion"]}', '{$data["telefono"]}', '{$data["contacto"]}', '{$data["foto"]}', '{$data["fecha_ingreso"]}', '{$data["latitud"]}', '{$data["longitud"]}')");