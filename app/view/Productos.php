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
                        <div class="content-panel mt-4" id="panelDatos">
                            <h4><i class="fa-solid fa-cart-shopping"></i>
                                <button id="btnagregar" class="btn btn-success btn-md ml-4" type="submit"><i class="fa-regular fa-square-plus"></i> Agregar Producto</button>
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
                                        <th scope="col">Restaurante</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Precio</th>
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
                            <h4><i class="fa-solid fa-cart-shopping"></i>
                            Producto
                            </h4>
                            <hr>
                            <form class="form-horizontal" role="form" id="miform" enctyper="multipart/form-data" action="" method="post">
                            <input type="hidden" name="idproducto" id="idproducto" value="0">
                            <div class="form-group row mb-3">
                                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" > 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required> 
                                </div>
                                
                            </div>

                            <div class="form-group row mb-3">  
                                <label for="restaurantesid" class="col-sm-2 col-form-label">Seleccionar Restaurante</label>
                                <div class="col-sm-10">
                                <select class="form-select form-select-lg mb-3" id="restauranteid" name="restauranteid"  style="width:350px" required>
                                    <option selected>Restaurantes</option>
                                    
                                    
                                </select> 
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                                <div class="col-sm-10">
                                <input type="number" class="form-control" id="precio" name="precio" step="0.01" required> 
                                </div>
                                
                            </div>
                            

                            <div class="form-group row mb-3">
                                <label for="fotop" class="col-sm-2 col-form-label">Foto Peque;a</label>
                                <div class="col-sm-10">
                                    <div class="img-thumbnail" id="divFotop" style="width: 200px; height: 200px;">
                                    </div>
                                    <span>Haga click aqui para seleccionar foto</span>
                                    <input class="d-none" type="file" id="fotop" name="fotop">
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="fotom" class="col-sm-2 col-form-label">Foto Mediana</label>
                                <div class="col-sm-10">
                                    <div class="img-thumbnail" id="divFotom" style="width: 200px; height: 200px;">
                                    </div>
                                    <span>Haga click aqui para seleccionar foto</span>
                                    <input class="d-none" type="file" id="fotom" name="fotom">
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="fotog" class="col-sm-2 col-form-label">Foto Grande</label>
                                <div class="col-sm-10">
                                    <div class="img-thumbnail" id="divFotog" style="width: 200px; height: 200px;">
                                    </div>
                                    <span>Haga click aqui para seleccionar foto</span>
                                    <input class="d-none" type="file" id="fotog" name="fotog">
                                </div>
                                
                            </div>
                            <div class="alert alert-danger d-none" id="mensaje">

                            </div>
                            <button id="btnCancelar" type="button" class="btn btn-danger">Cancelar</button>
                            <button type="submit" class="btn btn-success" >Guardar</button>

                            </form>
                            </div>
                        </div>
                    </div>

                    <!-- form ingredientes -->
                    <div class="content-panel mt-4 d-none" id="panelFormularioIngredientes">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                            <h4><i class="fas fa-pepper-hot"></i>
                            Ingredientes
                            </h4>
                            <hr>
                            <form class="form-horizontal" role="form" id="miformingrediente" enctyper="multipart/form-data" action="" method="post">
                            <input type="hidden" name="idingrediente" id="idingrediente" value="0">
            
                            <div class="form-group row mb-3">
                                <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required> 
                                </div>
                                
                            </div>

                            

                            <div class="form-group row mb-3">
                                <label for="costo" class="col-sm-2 col-form-label">Costo adicional</label>
                                <div class="col-sm-10">
                                <input type="number" class="form-control" id="costo" name="costo" step="0.01" required> 
                                </div>
                                
                            </div>
                            

                            
                            <div class="alert alert-danger d-none" id="mensaje">

                            </div>
                            <button id="btnCancelarI" type="button" class="btn btn-danger">Cancelar</button>
                            <button type="submit" class="btn btn-success" >Guardar</button>

                            </form>
                            </div>
                        </div>
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
    <script src="<?php echo URL; ?>public_html/js/productos.js"></script>


</body>


</html>