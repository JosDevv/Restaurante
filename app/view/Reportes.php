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
            <div class="col-sm-9">
                <section id="contenido">
                    <div class="content-panel mt-4">
                      <div class="row mb-3 p3 m1">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <label for="restaurante">Restaurante:</label>
                                <select class="form-control ml-2 mr-2" name="restaurante" id="restaurante" required></select>
                                <label for="fecha" >Fecha de Inicio</label>
                                <input type="date" class="form-control ml-2 mr-2" id="fechai" name="fechai" required> 
                                <label for="fecha">Fecha de Fin</label>
                                <input type="date" class="form-control ml-2 mr-2" id="fechaf" name="fechaf" required> 
                                

                                <button type="button" class="btn btn-primary" id="btnVer" name="btnVer"><i class="fas fa-print"></i>Ver Reporte</button>

                            </div>
                        </div>
                      </div>   
                         <iframe src="" width="100%" height="400" id="framereporte"></iframe>
                    </div>
                </section>

            </div>
        </div>
        
        
        <section id="pie">
        <?php include_once "app/view/secciones/pie.php" ?>
        </section>
    </div>

    <?php include_once "app/view/secciones/librerias.php" ?>
    <script src="<?php echo URL; ?>public_html/js/reportes.js"></script>


</body>


</html>