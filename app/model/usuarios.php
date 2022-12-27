<?php
include_once "app/model/db.class.php";
class Usuarios extends BaseDeDatos {
    public function __construct()
    {
        parent::conectar();
    }
    public function getAll()
    {
       return $this->executeQuery("SELECT `idusuario`, `usuario`, `nombres`, `apellidos`, `tipo`, `foto`, IF(`tipo`=1,'Administrador','Usuario') AS `ntipo` FROM `usuarios` ORDER BY `idusuario`");        
    }

    public function getUserByname($name)
    {
        return $this->executeQuery("SELECT `idusuario`, `usuario`, `nombres`, `apellidos`, `tipo`, `foto`, IF(`tipo`=1,'Administrador','Usuario') AS `ntipo` FROM `usuarios` WHERE `usuario`='{$name}'");        
     
    }
    public function save($data,$img)
    {
        return $this->executeInsert("INSERT INTO `usuarios`( `usuario`, `password`, `nombres`, `apellidos`, `tipo`, `foto` ) VALUES( '{$data["usuario"]}',MD5('{$data["password"]}'), '{$data["nombres"]}', '{$data["apellidos"]}', '{$data["tipo"]}', '{$img}' ) ");
    }

    public function getOneUser($id)
    {
        return $this->executeQuery("SELECT `idusuario`, `usuario`, `nombres`, `apellidos`, `tipo`, `foto`, IF(`tipo`=1,'Administrador','Usuario') AS `ntipo` FROM `usuarios` WHERE `idusuario`='{$id}'");
    }

    public function getUserBynameAndId($name,$id)
    {
        return $this->executeQuery("SELECT `idusuario`, `usuario`, `nombres`, `apellidos`, `tipo`, `foto`, IF(`tipo`=1,'Administrador','Usuario') AS `ntipo` FROM `usuarios` WHERE `usuario`='{$name}' AND `idusuario` <>'{$id}'");        
     
    }

    public function update($data,$img)
    {
        return $this->executeUpdate("UPDATE `usuarios` SET `usuario`='{$data["usuario"]}',`password`=if('{$data["password"]}'='', password,MD5('{$data["password"]}')),`nombres`='{$data["nombres"]}',`apellidos`='{$data["apellidos"]}',`tipo`='{$data["tipo"]}',`foto`=if('{$img}'='',foto,'{$img}') WHERE `idusuario`='{$data['id_usr']}' ");
    }

    public function deleteUser($id)
    {
        return $this->executeUpdate("DELETE FROM `usuarios` WHERE `idusuario`='{$id}'");
    }

}
?>