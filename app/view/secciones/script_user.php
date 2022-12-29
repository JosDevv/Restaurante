<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="<?php echo URL; ?>public_html/js/api_user.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo URL; ?>public_html/js/scripts.js"></script>
<script >
const btnView=document.querySelector("#btnVer");
const idrestaurantes=document.querySelector("#restaurante");
const frame=document.querySelector("#framereporte");
const fechai=document.querySelector("#fechai");
const fechaf=document.querySelector("#fechaf");
const API=new Api();

//eventos
eventListeners();

function eventListeners() {
    document.addEventListener("DOMContentLoaded", crearDatos);
    btnView.addEventListener("click",verReporte);
}

function crearDatos() {
   
    API.loadRestaurantes()
      .then((data) => {
        llenarRestaurantes(data.records); 
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  function llenarRestaurantes(records){
    console.log(records);
    idrestaurantes.innerHTML="";
    const optionRest=document.createElement("option");
    optionRest.value="0";
    optionRest.textContent="Todos";
    idrestaurantes.append(optionRest);
    records.forEach(item=>{
        const {idrestaurante,nombre_restaurante}=item;
        const optionRest=document.createElement("option");
        optionRest.value=idrestaurante;
        optionRest.textContent=nombre_restaurante;
        idrestaurantes.append(optionRest);
        
    });
 }

 function verReporte() {
    frame.src=`${BASE_API}Reportes/getReporte?id=${idrestaurantes.value}&fechai=${fechai.value}&fechaf=${fechaf.value}`;
    limpiarInputs();
 }
 function limpiarInputs() {
  idrestaurantes.value=0;
  fechai.value='';
  fechaf.value='';
 }







</script>