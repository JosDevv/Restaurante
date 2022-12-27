<?php
define('URL','/Restaurante/');
require_once "app/controller/ErroresController.php";
    require_once "app/controller/Controller.php";
$url=$_GET["action"] ?? null;
$url=rtrim($url,"/");
$url=explode("/",$url);
//print_r($url);
if (empty($url[0])) {
    $archivoController='app/controller/Main';
    $url[0]="Main";
}else{
    $archivoController="app/controller/{$url[0]}";   
}
$archivoController.='Controller.php';
if (file_exists($archivoController)) {
    require $archivoController;
    $url[0].="Controller";
    $controller=new $url[0]($url[1] ?? ""); 
}else{
    $controller=new ErroresController();
}

?>