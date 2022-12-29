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
            <div class="col-md-2  col-sm-4">
                <section id="menu">

                    <?php include_once "app/view/secciones/menu.php" ?>

                </section>
    
            </div>  
            <div class="col-md-9  col-sm-6">
                <section id="contenido">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="<?php echo URL; ?>public_html/img/1.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="<?php echo URL; ?>public_html/img/2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="<?php echo URL; ?>public_html/img/3.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="<?php echo URL; ?>public_html/img/4.png" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
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