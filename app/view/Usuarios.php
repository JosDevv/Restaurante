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
                            <h4><i class="fa-sharp fa-solid fa-user-tie" ></i>
                                <button id="btnagregar" class="btn btn-success btn-md ml-4" type="submit"><i class="fa-regular fa-square-plus"></i> Agregar Usuario</button>
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
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Usuarios</th>
                                        <th scope="col">Tipo</th>
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
                            <h4><i class="fa-sharp fa-solid fa-user-tie" ></i>
                            Usuarios
                            </h4>
                            <hr>
                            <form class="form-horizontal" role="form" id="miform" enctyper="multipart/form-data" action="" method="post">
                            <input type="hidden" name="id_usr" id="id_usr" value="0">
                            <div class="form-group row mb-3">
                                <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="usuario" name="usuario" > 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" required> 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombres" name="nombres" required> 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">
                                <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required> 
                                </div>
                                
                            </div>
                            <div class="form-group row mb-3">  
                            <label for="tipo" class="col-sm-2 col-form-label">Tipo de usuario</label>
                            <div class="col-sm-10">
                            <select class="form-select form-select-lg mb-3" id="tipo" name="tipo" aria-label="Ejemplo de .form-select-lg" style="width:350px" required>
                                <option selected>Tipo</option>
                                <option value="1">Admin</option>
                                <option value="2">Normal</option>
                                
                            </select> 
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
                            <div class="alert alert-danger d-none" id="mensaje">

                            </div>
                            <button id="btnCancelar" type="button" class="btn btn-danger">Cancelar</button>
                            <button type="submit" class="btn btn-success" >Guardar</button>

                            </form>
                            </div>
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
    <script src="<?php echo URL; ?>public_html/js/usuarios.js"></script>


</body>


</html>