<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once "app/view/secciones/css.php" ?>
</head>
<body>
    <div class="container-fluid">
        <section id="encabezado">

        <?php include_once "app/view/secciones/encabezado.php" ?>

        </section>
        <div class="row">
            <div class="col-sm-2">
                <section id="menu">

                    <?php include_once "app/view/secciones/menu.php" ?>

                </section>
    
            </div>  
            <div class="col-sm-10">
                <section id="contenido">
                    <h1>Contenido</h1>
                </section>
            </div>

        </div>
        <section id="pie">

        <?php include_once "app/view/secciones/pie.php" ?>

        </section>
    </div>

    <?php include_once "app/view/secciones/librerias.php" ?>


</body>


</html>