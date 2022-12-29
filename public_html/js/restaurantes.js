const btnNew = document.querySelector("#btnagregar");
const btnCancelar = document.querySelector("#btnCancelar");
const panelDatos = document.querySelector("#panelDatos");
const panelFormulario = document.querySelector("#panelFormulario");
const mensaje = document.querySelector("#mensaje");
const tableContent = document.querySelector("#contentTable table tbody");
const txtSearch = document.querySelector("#txtSearch");
const paginacion = document.querySelector(".pagination");
const divfoto = document.querySelector("#divFoto");
const inputfoto = document.querySelector("#foto");
const miForm = document.querySelector("#miform");
const mapaDashboard = document.querySelector("#mapp");
//para paginacion 4 registros
const recordsShow = 5;
const API = new Api();
let marker;

const objDatos = {
  records: [],
  recordsFilter: [],
  currentPage: 1,
  markers: [],
  filter: "",
};

eventListener();

function eventListener() {
  btnNew.addEventListener("click", agregarRestaurantes);
  btnCancelar.addEventListener("click", mostrarTabla);
  document.addEventListener("DOMContentLoaded", crearDatos);
  txtSearch.addEventListener("input", aplicarFiltro);
  divfoto.addEventListener("click", addfoto);
  inputfoto.addEventListener("change", actualizarFoto);
  miForm.addEventListener("submit", guardarRestaurante);
}
//funcion para simular clik en div foot
function addfoto() {
  inputfoto.click();
}
//funcion para agregar la foto al div
function actualizarFoto(el) {
  if (el.target.files && el.target.files[0]) {
    const reader = new FileReader();
    reader.onload = (e) => {
      divfoto.innerHTML = `<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;"></img>`;
    };
    reader.readAsDataURL(el.target.files[0]);
  }
}
//funcion para mostrar el fomrulario
function agregarRestaurantes() {
  initMap();
  panelDatos.classList.add("d-none");
  mapaDashboard.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

//funcion para limpiar el formulario
function limpiarForm() {
  miForm.reset();

  document.querySelector("#idrestaurante").value = "0";
  document.querySelector("#lat").value = "";
  document.querySelector("#long").value = "";
  divFoto.innerHTML = "";
}

//funcion para iniciar el mapa de Google
function initMap() {
  const salvador = { lat: 13.701035, lng: -89.224434 };
  map = new google.maps.Map(document.getElementById("map"), {
    center: salvador,
    zoom: 15,
  });

  // Agrega un evento click al mapa
  map.addListener("click", function (e) {
    //  addMarker(e.latLng);

    // Obtiene las coordenadas del click
    var lat = e.latLng.lat();
    var lng = e.latLng.lng();
    document.querySelector("#lat").value = lat;
    document.querySelector("#long").value = lng;

    // Agrega un evento click al mapa
    map.addListener("click", function (e) {
      // Obtiene las coordenadas del click
      var lat = e.latLng.lat();
      var lng = e.latLng.lng();

      // Si ya existe un marcador en el mapa, lo elimina
      if (marker) {
        marker.setMap(null);
      }

      // Crea un marcador en las coordenadas del click
      marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: map,
      });
    });
  });

  //addMarker(salvador);
}

function initMapDashboard() {
  const salvador = { lat: 13.701035, lng: -89.224434 };
  mapp = new google.maps.Map(document.getElementById("mapp"), {
    center: salvador,
    zoom: 15,
  });

  // Agrega un evento click al mapa
  map.addListener("click", function (e) {
    //  addMarker(e.latLng);

    // Obtiene las coordenadas del click
    var lat = e.latLng.lat();
    var lng = e.latLng.lng();
    document.querySelector("#lat").value = lat;
    document.querySelector("#long").value = lng;

    // Agrega un evento click al mapa
    map.addListener("click", function (e) {
      // Obtiene las coordenadas del click
      var lat = e.latLng.lat();
      var lng = e.latLng.lng();

      // Si ya existe un marcador en el mapa, lo elimina
      if (marker) {
        marker.setMap(null);
      }

      // Crea un marcador en las coordenadas del click
      marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: map,
      });
    });
  });

  //addMarker(salvador);
}
function hideMarkers() {
  if (marker) {
    marker.setMap(null);
  }
}

function addMarker(position) {
  marker2 = new google.maps.Marker({
    position,
    map: map,
  });
}
function addMarkerD(positions) {
  marker2 = new google.maps.Marker({
    position: { lat: Number(positions["lat"]), lng: Number(positions["lng"]) },
    map: mapp,
  });
}

//funcion para actualizar los restaurantes
function editarRestaurante(id) {
  limpiarForm();
  panelDatos.classList.add("d-none");
  mapaDashboard.classList.add("d-none");
  panelFormulario.classList.remove("d-none");

  API.getOneRestaurante(id)
    .then((data) => {
      if (data.success) {
        mostrarDatosForm(data.records[0]);
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.msg,
        });
      }
    })
    .catch((error) => {
      console.error("Error: ", error);
    });
}
//funcion para rellenar el formulario cuando se da un update
function mostrarDatosForm(records) {
  const {
    idrestaurante,
    nombre_restaurante,
    direccion,
    telefono,
    contacto,
    fecha_ingreso,
    foto,
    latitud,
    longitud,
  } = records;
  document.querySelector("#idrestaurante").value = idrestaurante;
  document.querySelector("#nombre_restaurante").value = nombre_restaurante;
  document.querySelector("#direccion").value = direccion;
  document.querySelector("#telefono").value = telefono;
  document.querySelector("#contacto").value = contacto;
  document.querySelector("#fecha").value = fecha_ingreso;
  document.querySelector("#lat").value = latitud;
  document.querySelector("#long").value = longitud;
  initMap();

  addMarker({ lat: Number(latitud), lng: Number(longitud) });
  //latitud
  //longitud
  divfoto.innerHTML = `<img src="${foto}" class="h-100 w-100" style="object-fit:contain;"></img>`;
}

//funcion para mostrar la tabla
function mostrarTabla() {
  hideMarkers();
  panelDatos.classList.remove("d-none");
  mapaDashboard.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  crearDatos();
}

//funcion para cargar los datos en la tabla cuando el DOM se carga
function crearDatos() {
  initMap();
  API.loadRestaurantes()
    .then((data) => {
      if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
      } else {
        mensaje.textContent = data.msg;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function setMapOnAll() {
  for (let i = 0; i < objDatos.markers.length; i++) {
    objDatos.markers[i].setMap(mapp);
  }
}

//funcion para dibujar la tabla luego de optenerla en la funcion crearDatos
function crearTabla() {
  initMapDashboard();
  if (objDatos.filter === "") {
    objDatos.recordsFilter = objDatos.records.map((item) => item);

    objDatos.recordsFilter.forEach((item, index) => {
      objDatos.markers.push({ lat: item["latitud"], lng: item["longitud"] });
      addMarkerD({ lat: item["latitud"], lng: item["longitud"] });
    });
    
  } else {
    objDatos.markers.splice(0, objDatos.markers.length); //elimino los elementos del array para agregar los del filtro
    objDatos.recordsFilter = objDatos.records.filter((item) => {
     
      objDatos.markers.push({ lat: item["latitud"], lng: item["longitud"] });
      addMarkerD({ lat: item["latitud"], lng: item["longitud"] });
      const {
        contacto,
        direccion,
        fecha_ingreso,
        idrestaurante,
        nombre_restaurante,
        telefono,
      } = item;
      if (
        contacto.toLowerCase().search(objDatos.filter.toLowerCase()) != -1 ||
        direccion.toLowerCase().search(objDatos.filter.toLowerCase()) != -1 ||
        fecha_ingreso.toLowerCase().search(objDatos.filter.toLowerCase()) !=-1 ||
        nombre_restaurante.toLowerCase().search(objDatos.filter.toLowerCase()) != -1 ||
        telefono.toLowerCase().search(objDatos.filter.toLowerCase()) != -1
      ) {
        return item;
      }
    });
  }
  const recordIni = objDatos.currentPage * recordsShow - recordsShow;
  const recordFin = recordIni + recordsShow - 1;
  let html = "";

  objDatos.recordsFilter.forEach((item, index) => {
    if (index >= recordIni && index <= recordFin) {
      const {
        contacto,
        direccion,
        fecha_ingreso,
        idrestaurante,
        nombre_restaurante,
        telefono,
        latitud,
        longitud,
      } = item;
      html += `<tr>
        <td scope="col">${index + 1}</td>
        <td scope="col">${nombre_restaurante}</td>
        <td scope="col">${direccion}</td>
        <td scope="col">${telefono}</td>
        <td scope="col">${contacto}</td>
        <td scope="col">${fecha_ingreso}</td>
        <td scope="col">${latitud}</td>
        <td scope="col">${longitud}</td>
        
        <td scope="col"><button class="btn btn-primary btn-xs" onClick="editarRestaurante(${
          item.idrestaurante
        })" ><i class="far fa-edit"></i></button>
        <button class="btn btn-danger btn-xs" onClick="eliminarRestaurante(${
          item.idrestaurante
        })" ><i class="far fa-trash-alt"></i></button></td>
        </tr>
        
        `;
    }
  });

  tableContent.innerHTML = html;
  crearPaginacion();
  
}
//funcion para eliminar un registro
function eliminarRestaurante(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el Registro",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: "No",
  })
    .then((result) => {
      if (result.isConfirmed) {
        API.deleteRestaurante(id)
          .then((data) => {
            if (data.success) {
              mostrarTabla();
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: data.msg,
              });
            }
          })
          .catch((error) => {
            console.error("Error: ", error);
          });
      }
    })
    .catch();
}

//funcion para crear la paginacion
function crearPaginacion() {
  while (paginacion.firstElementChild) {
    paginacion.removeChild(paginacion.firstElementChild);
  }
  const Anterior = document.createElement("li");
  Anterior.classList.add("page-item");
  Anterior.innerHTML = `<a class="page-link" href="#">Anterior</a>`;
  Anterior.onclick = () => {
    objDatos.currentPage =
      objDatos.currentPage == 1 ? 1 : --objDatos.currentPage;
    crearTabla();
  };
  paginacion.append(Anterior);
  const totalPage = Math.ceil(objDatos.recordsFilter.length / recordsShow);
  for (let i = 1; i <= totalPage; i++) {
    const el = document.createElement("li");
    el.classList.add("page-item");
    el.innerHTML = `<a class="page-link" href="#">${i}</a>`;
    el.onclick = () => {
      objDatos.currentPage = i;
      crearTabla();
    };
    paginacion.append(el);
  }
  const Siguiente = document.createElement("li");
  Siguiente.classList.add("page-item");
  Siguiente.innerHTML = `<a class="page-link" href="#">Siguiente</a>`;
  Siguiente.onclick = () => {
    objDatos.currentPage =
      objDatos.currentPage == totalPage ? totalPage : ++objDatos.currentPage;
    crearTabla();
  };
  paginacion.append(Siguiente);
}
//funcion para aplicar los filtros
function aplicarFiltro(e) {
  e.preventDefault();
  objDatos.filter = this.value;
  crearTabla();
}
//funcion para guardar el Form
function guardarRestaurante(e) {
  e.preventDefault();
  const formData = new FormData(miForm);
 
  API.saveRestaurante(formData)
    .then((data) => {
      if (data.success) {
        mostrarTabla();
        hideMarkers();
        Swal.fire({
          icon: "info",
          text: data.msg,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.msg,
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
