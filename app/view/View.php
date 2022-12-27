<?php
class View{
    function Render($View){
        require "app/view/$View.php";
    }
}

?>