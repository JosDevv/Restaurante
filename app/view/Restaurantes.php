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
                        <div class="content-panel mt-4" id="panelDatos">
                            <h4><i class="fa-solid fa-utensils"></i>
                                <button id="btnagregar" class="btn btn-success btn-md ml-4" type="submit"><i class="fa-regular fa-square-plus"></i> Agregar Restaurante</button>
                            </h4>
                            <hr>
                        <div id="contentTable">
                            <div class="row mb-1">
                                <div class="input-group col-md-4">
                                    <input type="search" class="form-control" name="txt-buscar" id="txtSearch" placeholder="Buscar...">
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Corr</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Direccion</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Contacto</th>
                                        <th scope="col">Fecha De Ingreso</th>
                                        <th scope="col">Latitud</th>
                                        <th scope="col">Longitud</th>
                                        
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-md-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                </ul>
                                </nav>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-panel mt-4 d-none" id="panelFormulario">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                            <h4><i class="fa-solid fa-utensils"></i>
                            Restaurante
                            </h4>
                            <hr>
                            <form class="form-horizontal" role="form" id="miform" enctyper="multipart/form-data" action="" method="post">
                            <input type="hidden" name="idrestaurante" id="idrestaurante" value="0">
                            <div class="form-group row mb-3">
                                <label for="nombre_restaurante" class="col-sm-2 col-form-label">Nombre de Restaurante</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_restaurante" name="nombre_restaurante" > 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion" name="direccion" required> 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono" name="telefono" required> 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="contacto" class="col-sm-2 col-form-label">Contacto</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="contacto" name="contacto" required> 
                                </div>
                                
                            </div>

                            <div class="form-group row mb-3">
                                <label for="fecha" class="col-sm-2 col-form-label">Fecha de Ingreso</label>
                                <div class="col-sm-10">
                                <input type="date" class="form-control" id="fecha" name="fecha" required> 
                                </div>
                                
                            </div>

                            <div class="form-group row mb-3">
                                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <div class="img-thumbnail" id="divFoto" style="width: 200px; height: 200px;">
                                    </div>
                                    <span>Haga click aqui para seleccionar foto</span>
                                    <input class="d-none" type="file" id="foto" name="foto">
                                </div>
                                
                            </div>

                            <div class="form-group row mb-3">
                            <label for="latlng" class="col-sm-2 col-form-label">Seleccione una ubicacion</label>
                            <div class="col-sm-10 w-75" id="map" style="height: 400px; "></div>
                            

                            <input type="hidden" name="lat" id="lat" >
                            <input type="hidden" name="long" id="long" >
                            </div>
                            <div class="alert alert-danger d-none" id="mensaje">

                            </div>
                            <button id="btnCancelar" type="button" class="btn btn-danger">Cancelar</button>
                            <button type="submit" class="btn btn-success" >Guardar</button>

                            </form>
                            </div>
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
    <script src="<?php echo URL; ?>public_html/js/restaurantes.js"></script>


</body>


</html>