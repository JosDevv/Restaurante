const btnNew=document.querySelector("#btnagregar");
const btnCancelar=document.querySelector("#btnCancelar");
const panelDatos=document.querySelector("#panelDatos");
const panelFormulario=document.querySelector("#panelFormulario");
const mensaje=document.querySelector("#mensaje");
const tableContent=document.querySelector("#contentTable table tbody");
const txtSearch=document.querySelector("#txtSearch");
const paginacion=document.querySelector(".pagination");
const divfoto=document.querySelector("#divFoto");
const inputfoto=document.querySelector("#foto");
const miForm=document.querySelector("#miform");
//para paginacion 4 registros
const recordsShow=5;
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    filter:""
};

eventListener();

function eventListener() {
    btnNew.addEventListener("click",agregarRestaurantes);
    btnCancelar.addEventListener("click",mostrarTabla);
    document.addEventListener("DOMContentLoaded",crearDatos);
    txtSearch.addEventListener("input",aplicarFiltro);
    divfoto.addEventListener("click",addfoto);
    inputfoto.addEventListener("change",actualizarFoto);
    miForm.addEventListener("submit",guardarRestaurante);
}
//funcion para simular clik en div foot
function addfoto() {
    inputfoto.click();

}
//funcion para agregar la foto al div
function actualizarFoto(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divfoto.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;"></img>`;
        }
        reader.readAsDataURL(el.target.files[0]);
        
    }
}
//funcion para mostrar el fomrulario
function agregarRestaurantes() {
    panelDatos.classList.add("d-none");
    panelFormulario.classList.remove("d-none");
    limpiarForm();
    
}
//funcion para actualizar los restaurantes
function editarRestaurante(id){
    //limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelFormulario.classList.remove("d-none");
    API.getOneRestaurante(id)
    .then(data=>{
        if (data.success) {
            mostrarDatosForm(data.records[0]);
        }else{
            Swal.fire({
                icon:"error",
                title:"Error",
                text:data.msg
            });

        }
    }

    )
    .catch(error=>{
        console.error("Error: ",error);
    }

    );
}
//funcion para rellenar el formulario cuando se da un update
function mostrarDatosForm(records) {
    const {idrestaurante,nombre_restaurante,direccion,telefono,contacto,fecha_ingreso,foto}=records
    document.querySelector("#idrestaurante").value=idrestaurante;
    document.querySelector("#nombre_restaurante").value=nombre_restaurante;
    document.querySelector("#direccion").value=direccion;
    document.querySelector("#telefono").value=telefono;
    document.querySelector("#contacto").value=contacto;
    document.querySelector("#fecha").value=fecha_ingreso;
    //latitud
    //longitud
    divfoto.innerHTML=`<img src="${foto}" class="h-100 w-100" style="object-fit:contain;"></img>`;

}

//funcion para mostrar la tabla
function mostrarTabla() {
    panelDatos.classList.remove("d-none");
    panelFormulario.classList.add("d-none");
    crearDatos();
}

//funcion para cargar los datos en la tabla cuando el DOM se carga
function crearDatos(){
    API.loadRestaurantes().then(data=>{
        if(data.success){
            objDatos.records=data.records;
            objDatos.currentPage=1;
            crearTabla();
        }else{
            mensaje.textContent=data.msg;
        }
    }).catch(error=>{
       console.error("Error:",error);

    });
}

//funcion para dibujar la tabla luego de optenerla en la funcion crearDatos
function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
        
    }else{
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const {contacto,direccion,fecha_ingreso,idrestaurante,nombre_restaurante,telefono}=item;
            if ((contacto.toLowerCase().search(objDatos.filter.toLowerCase())!=-1) || (direccion.toLowerCase().search(objDatos.filter.toLowerCase())!=-1) || (fecha_ingreso.toLowerCase().search(objDatos.filter.toLowerCase())!=-1) || (nombre_restaurante.toLowerCase().search(objDatos.filter.toLowerCase())!=-1)) {
                return item;
                
            }
            
        });  
    }
    const recordIni=(objDatos.currentPage*recordsShow)-recordsShow;
    const recordFin=(recordIni+recordsShow)-1;
    let html="";
    
    objDatos.recordsFilter.forEach((item,index) => {
        if ((index>=recordIni)&&(index<=recordFin)) {
            const {contacto,direccion,fecha_ingreso,idrestaurante,nombre_restaurante,telefono,latitud,longitud}=item;
        html+=`<tr>
        <td scope="col">${index+1}</td>
        <td scope="col">${nombre_restaurante}</td>
        <td scope="col">${direccion}</td>
        <td scope="col">${telefono}</td>
        <td scope="col">${contacto}</td>
        <td scope="col">${fecha_ingreso}</td>
        <td scope="col">${latitud}</td>
        <td scope="col">${longitud}</td>
        
        <td scope="col"><button class="btn btn-primary btn-xs" onClick="editarRestaurante(${item.idrestaurante})" ><i class="far fa-edit"></i></button>
        <button class="btn btn-danger btn-xs" onClick="eliminarUsuario(${item.idrestaurante})" ><i class="far fa-trash-alt"></i></button></td>
        </tr>
        
        `;
    }});

    tableContent.innerHTML=html;
    crearPaginacion();
}
//funcion para eliminar un registro
function eliminarUsuario(id){
    Swal.fire({
        title:"Esta seguro de eliminar el Registro",
        showDenyButton : true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(result=>{
        if (result.isConfirmed) {
            API.deleteRestaurante(id).then(data=>{
                if (data.success) {
                    mostrarTabla();
                }else{
                    Swal.fire({
                        icon:"error",
                        title:"Error",
                        text:data.msg
                    });
                }
            }).catch(error=>{
                console.error("Error: ",error);
            });

        }
    }).catch();
}

//funcion para crear la paginacion
function crearPaginacion() {
    while(paginacion.firstElementChild){
        paginacion.removeChild(paginacion.firstElementChild);
    }
    const Anterior=document.createElement("li");
    Anterior.classList.add("page-item");
    Anterior.innerHTML=`<a class="page-link" href="#">Anterior</a>`;
    Anterior.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1 : --objDatos.currentPage );
        crearTabla();
    }
    paginacion.append(Anterior);
    const totalPage=Math.ceil(objDatos.recordsFilter.length/recordsShow);
    for(let i=1 ; i<=totalPage ; i++ ){
        const el=document.createElement("li");
        el.classList.add("page-item");
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=>{
            objDatos.currentPage=i;
            crearTabla();
        }
        paginacion.append(el);
    }
    const Siguiente=document.createElement("li");
    Siguiente.classList.add("page-item");
    Siguiente.innerHTML=`<a class="page-link" href="#">Siguiente</a>`;
    Siguiente.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage : ++objDatos.currentPage );
        crearTabla();
    }
    paginacion.append(Siguiente);
}
//funcion para aplicar los filtros 
function aplicarFiltro(e) {
    e.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}
//funcion para guardar el Form
function guardarRestaurante(e) {
    e.preventDefault();
    const formData=new FormData(miForm);
    console.log(formData);
    API.saveRestaurante(formData)
    .then(data=>{
        if (data.success) {
            mostrarTabla();
            Swal.fire({
                icon:"info",
                text:data.msg
            });
        }else{
            Swal.fire({
                icon:"error",
                title:"Error",
                text:data.msg
            });
        }
    })
    .catch(error=>{
        console.error("Error:",error);
    });
}