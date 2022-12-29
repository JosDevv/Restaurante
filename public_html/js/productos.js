const btnNew=document.querySelector("#btnagregar");
const btnCancelar=document.querySelector("#btnCancelar");
const btnCancelarI=document.querySelector("#btnCancelarI");
const panelDatos=document.querySelector("#panelDatos");
const panelFormulario=document.querySelector("#panelFormulario");
const panelFormularioIngredientes=document.querySelector("#panelFormularioIngredientes");//
const mensaje=document.querySelector("#mensaje");
const tableContent=document.querySelector("#contentTable table tbody");
const txtSearch=document.querySelector("#txtSearch");
const paginacion=document.querySelector(".pagination");
const divfotop=document.querySelector("#divFotop");
const divfotom=document.querySelector("#divFotom");
const divfotog=document.querySelector("#divFotog");
const inputfotop=document.querySelector("#fotop");
const inputfotom=document.querySelector("#fotom");
const inputfotog=document.querySelector("#fotog");
const idrestaurantes=document.querySelector("#restauranteid");
const miForm=document.querySelector("#miform");
const miFormI=document.querySelector("#miformingrediente");
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
    btnNew.addEventListener("click",agregarprecio);
    btnCancelar.addEventListener("click",mostrarTabla);
    btnCancelarI.addEventListener("click",mostrarTabla);
   
    document.addEventListener("DOMContentLoaded",crearDatos);
    txtSearch.addEventListener("input",aplicarFiltro);
    divfotop.addEventListener("click",addfotop);
    divfotom.addEventListener("click",addfotom);
    divfotog.addEventListener("click",addfotog);
    inputfotop.addEventListener("change",actualizarFotop);
    inputfotom.addEventListener("change",actualizarFotom);
    inputfotog.addEventListener("change",actualizarFotog);
    miForm.addEventListener("submit",guardarproducto);
    miFormI.addEventListener("submit",guardarIngrediente);
}

function mostrarTabla() {
    panelDatos.classList.remove("d-none");
    panelFormulario.classList.add("d-none");
    panelFormularioIngredientes.classList.add("d-none");
    crearDatos();
}

//funcion para guardar los registros
function guardarproducto(e) {
    e.preventDefault();
    const formData=new FormData(miForm);

    API.saveProducto(formData)
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
function guardarIngrediente(e) {
    e.preventDefault();
    const formData=new FormData(miFormI);

    API.saveIngrediente(formData)
    .then(data=>{
        if (data.success) {
            mostrarTabla();
            miFormI.reset();
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

//funcion para mostrar el formulario
function agregarprecio() {
    panelDatos.classList.add("d-none");
    panelFormulario.classList.remove("d-none");
    limpiarForm();
    
}
function limpiarForm() {
    miForm.reset();
    
    document.querySelector("#idproducto").value="0";
    //document.querySelector("#restaurantesid").value="1";
    divFotop.innerHTML="";
    divFotom.innerHTML="";
    divFotog.innerHTML="";
    
}
//funcion para ir a traer los datos 
function crearDatos(){
    API.loadProductos().then(data=>{
        if(data.success){
            objDatos.records=data.records;
            objDatos.currentPage=1;
            crearTabla();
            return API.loadRestaurantes();
        }else{
            mensaje.textContent=data.msg;
        }
    }).then(data=>{
       llenarRestaurantes(data.records); 
    })
    .catch(error=>{
       console.error("Error:",error);

    });
}

function llenarRestaurantes(records){
    
    idrestaurantes.innerHTML="";
    records.forEach(item=>{
        const {idrestaurante,nombre_restaurante}=item;
        const optionRest=document.createElement("option");
        optionRest.value=idrestaurante;
        optionRest.textContent=nombre_restaurante;
        idrestaurantes.append(optionRest);
        
    });
 }

function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
        
    }else{
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const {nombre,descripcion,precio,nombre_restaurante}=item;//cambiar para los demas campos
            if ((nombre.toLowerCase().search(objDatos.filter.toLowerCase())!=-1) || (precio.toLowerCase().search(objDatos.filter.toLowerCase())!=-1) || (nombre_restaurante.toLowerCase().search(objDatos.filter.toLowerCase())!=-1)) {
                return item;
                
            }
            
        });  
    }
    const recordIni=(objDatos.currentPage*recordsShow)-recordsShow;
    const recordFin=(recordIni+recordsShow)-1;
    let html="";
    
    objDatos.recordsFilter.forEach((item,index) => {
        if ((index>=recordIni)&&(index<=recordFin)) {
        const {nombre,descripcion,precio,idrestarutante,nombre_restaurante}=item;
        html+=`<tr>
        <td scope="col">${index+1}</td>
        <td scope="col">${nombre_restaurante}</td>
        <td scope="col">${nombre}</td>
        <td scope="col">${descripcion}</td>
        <td scope="col">${precio}</td>
        
        
        <td scope="col"><button class="btn btn-primary btn-xs" onClick="editarproducto(${item.idproducto})" ><i class="far fa-edit"></i></button>
        <button class="btn btn-danger btn-xs" onClick="eliminarproducto(${item.idproducto})" ><i class="far fa-trash-alt"></i></button>
        <button class="btn btn-success btn-xs" onClick="AgregarIngrediente(${item.idproducto})" ><i class="fas fa-pepper-hot"></i></button>
        </td>
        </tr>
        
        `;
    }});

    tableContent.innerHTML=html;
    crearPaginacion();
}

function AgregarIngrediente(id) {
    //const {idproducto,nombre,descripcion,precio,idrestarutante,nombre_restaurante}=item;
    limpiarForm();
    
    panelDatos.classList.add("d-none");
    panelFormulario.classList.add("d-none");
    panelFormularioIngredientes.classList.remove("d-none");
    
    document.querySelector("#idingrediente").value=id;
    


}

function editarproducto(id){
    limpiarForm();
    panelDatos.classList.add("d-none");
    panelFormulario.classList.remove("d-none");
    API.getOneProducto(id)
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

function eliminarproducto(id){
    Swal.fire({
        title:"Esta seguro de eliminar el Registro",
        showDenyButton : true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(result=>{
        if (result.isConfirmed) {
            API.deleteProducto(id).then(data=>{
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

function mostrarDatosForm(records) {
    const {idproducto,idrestarutante,nombre,descripcion,foto1,foto2,foto3,precio,nombre_restaurante}=records
    document.querySelector("#idproducto").value=idproducto;
    document.querySelector("#nombre").value=nombre;
    document.querySelector("#descripcion").value=descripcion;
    document.querySelector("#restauranteid").value=idrestarutante;
    document.querySelector("#precio").value=precio;
    
    divfotop.innerHTML=`<img src="${foto1}" class="h-100 w-100" style="object-fit:contain;"></img>`;
    divfotom.innerHTML=`<img src="${foto2}" class="h-100 w-100" style="object-fit:contain;"></img>`;
    divfotog.innerHTML=`<img src="${foto3}" class="h-100 w-100" style="object-fit:contain;"></img>`;

}

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

function aplicarFiltro(e) {
    e.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function addfotop() {
    inputfotop.click();

}
function addfotom() {
    inputfotom.click();

}
function addfotog() {
    inputfotog.click();

}

function actualizarFotop(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divfotop.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;"></img>`;
        }
        reader.readAsDataURL(el.target.files[0]);
        
    }
}
function actualizarFotom(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divfotom.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;"></img>`;
        }
        reader.readAsDataURL(el.target.files[0]);
        
    }
}
function actualizarFotog(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divfotog.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;"></img>`;
        }
        reader.readAsDataURL(el.target.files[0]);
        
    }
}