<?php
require_once "/var/www/html/Restaurante/app/view/View.php";
class Controller{
    public $view;
    //creo un constructor con 3 parametros el parametro validar servira para saber si esa vista esta protegida o es de acceso publico
    public function __construct($view,$param,$validar=false){
        $this->view=new View();
        //si pido que la vista tiene que estar validada
        if ($validar) {
            //en caso de que la variable _SESSION no este iniciada la inicio 
            if (!isset($_SESSION)) {
                session_start();
            }
            //en el caso de que el id usuaro no exista lo mando al main
            echo $_SESSION["nombres"];
            if (!isset($_SESSION["id_usr"])) {
                $this->view->Render("Main");
                exit(0);
            }
        }
        if (empty($param)) {
            
            $this->view->Render($view);
            return;
        }
        if(method_exists($this,$param)){
            $this->$param();

        }else{
            echo "metodo no existe ";
            //$this->view->render($view);
        }
    }

}

?>