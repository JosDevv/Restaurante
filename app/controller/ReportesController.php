<?php
include_once "app/model/restaurantes.php";
include_once "app/model/productos.php";
require_once 'vendor/autoload.php';
//libreria de pdf
use Dompdf\Dompdf;
    class ReportesController extends Controller {
        private $restaurante;
        private $productos;
        public function __construct($param){
            $this->restaurante=new Restaurante();
            $this->productos=new Productos();
            parent::__construct("Reportes",$param);
        }
        //fucion que optiene los registros ya filtrados
        public function getReporte()
        {  
            
            $resultadoProductos=$this->productos->getAllProdctosReportes($_GET);
            //variable para contruir el reporte
            $html="<h1>Il Forno della Pasta</h1><br> <h2>Reporte</h2>";
            $html.="<h3>Nuestro restaurante es el lugar perfecto para disfrutar de deliciosas pastas frescas hechas a mano. Ofrecemos una amplia variedad de opciones, desde clásicos como spaghetti con albóndigas y lasagna hasta opciones más innovadoras como nuestra pasta de calabacín y nuestra pasta de espinacas y nueces. También tenemos opciones vegetarianas y veganas disponibles.</h3>";
            $html.="<h3>Listado De Productos</h3>";
            $html.="<table width='100%' border=1><thead><tr>";
            $html.="<th>corr</th>";
            $html.="<th>Nombre Producto</th>";
            $html.="<th>Descripcion</th>";
            $html.="<th>Nombre Restaurante</th>";
            $html.="<th>Fecha de Ingreso</th>";
            $html.="<th>Precio</th>";
            $html.="</tr></thead><tbody>";
            foreach ($resultadoProductos as $key => $value) {
                $html.="<tr>";
                $html.="<td>".($key+1)."</td>";
                $html.="<td>{$value['nombre']}</td>";
                $html.="<td>{$value['descripcion']}</td>";
                $html.="<td>{$value['nombre_restaurante']}</td>";
                $html.="<td>{$value['fecha_ingreso']}</td>";
                $html.="<td>{$value['precio']}</td>";
                $html.="</tr>";
                
            }
            
            $html.="</tbody></table>";
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // genera la salida en pdf en el navegador en este caso en un iframe
            $pdf = $dompdf->output();  
            echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdf) . '" style="width:100%; height:500px;"></iframe>';       



        }
       
        
    }
    
?>