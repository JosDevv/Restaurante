
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light"><img class="img-rounded" src="<?php echo URL; ?>public_html/img/LOGO.png" alt="a" width="150" ></div>
                <div class="list-group list-group-flush">
                    
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#">Reportes</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?php echo URL ?>Login/cerrar"><?php if($_SESSION["nuser"]){ echo 'Cerrar Sesion'; }else{ echo'Iniciar Sesion'; } ?></a>
                  
                </div>
            </div>

     