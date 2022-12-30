<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once "app/view/secciones/css.php" ?>
</head>
<body>
    <div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
        <section id="encabezado">
        <?php include_once "app/view/secciones/encabezado.php" ?>
        </section>
        <div class="row">
            
                <section id="menu">
                <div class="d-flex" id="wrapper">
                    <?php include_once "app/view/secciones/menu.php" ?>
                    <div class="container-fluid">
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
                    </div>
                </div>
                </section>

            
        </div>
        
        
        <section id="pie">
        <?php include_once "app/view/secciones/pie.php" ?>
        </section>
    </div>

    <?php include_once "app/view/secciones/librerias.php" ?>
    <script src="<?php echo URL; ?>public_html/js/reportes.js"></script>


</body>


</html>