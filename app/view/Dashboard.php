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
            <div class="col-md-10  col-sm-8">
                <section id="contenido">
                <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light" style="background-image: url('/Restaurante/public_html/img/4kpasta.jpg'); background-size: cover; background-position: center; opacity: 0.9;">
                    <div class="col-md-6 p-lg-5 mx-auto my-5" style="background-color: rgba(255, 255, 255, 0.7);">
                        <h1 class="display-4 font-weight-normal">Il Forno della Pasta</h1>
                        <p class="lead font-weight-normal">Nuestro ambiente es acogedor y familiar, y estamos seguros de que encontrarás algo que te guste en nuestro menú. ¡Te esperamos!</p>
                        <!-- <a class="btn btn-outline-secondary" href="#">Coming soon</a> -->
                    </div>
                    
                </div>

                    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
                        <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 w-50 text-center text-white overflow-hidden" >
                            <div class="my-3 py-3">
                            <h2 class="display-5">Spaghetti con albóndigas</h2> 
                            <p class="lead">Este clásico plato italiano consiste en spaghetti cocido al dente servido con albóndigas de carne picada y salsa de tomate casera. Puedes añadir queso rallado por encima para darle un toque extra de sabor.</p>
                            </div>
                            <div class="mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0; background-image: url('/Restaurante/public_html/img/spageti.jpg'); background-size: cover; background-position: center; opacity: 0.9;"></div>
                        </div>

                    
                        <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 w-50 text-center overflow-hidden">
                            <div class="my-3 p-3">
                            <h2 class="display-5">Lasagna</h2>
                            <p class="lead">La lasagna es una lasaña de varias capas hecha con pasta fresca, carne molida, salsa de tomate y queso rallado. Se cocina en el horno hasta que esté crujiente y dorada por encima. Es un plato familiar y muy satisfactorio.</p>
                            </div>
                            <div class="mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0; background-image: url('/Restaurante/public_html/img/lasana.jpg'); background-size: cover; background-position: center; opacity: 0.9;"></div>
                        </div>
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