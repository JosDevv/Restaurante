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