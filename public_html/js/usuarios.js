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
//para paginacion 4 registros
const recordsShow = 5;
const API = new Api();
const objDatos = {
  records: [],
  recordsFilter: [],
  currentPage: 1,
  filter: "",
};

eventListener();

function eventListener() {
  btnNew.addEventListener("click", agregarUsuario);
  btnCancelar.addEventListener("click", mostrarTabla);

  document.addEventListener("DOMContentLoaded", crearDatos);
  txtSearch.addEventListener("input", aplicarFiltro);
  divfoto.addEventListener("click", addfoto);
  inputfoto.addEventListener("change", actualizarFoto);
  miForm.addEventListener("submit", guardarUsuario);
}

function crearDatos() {
  API.loadData()
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

function crearTabla() {
  if (objDatos.filter === "") {
    objDatos.recordsFilter = objDatos.records.map((item) => item);
  } else {
    objDatos.recordsFilter = objDatos.records.filter((item) => {
      const { nombres, apellidos, usuario, ntipo } = item;
      if (
        nombres.toLowerCase().search(objDatos.filter.toLowerCase()) != -1 ||
        apellidos.toLowerCase().search(objDatos.filter.toLowerCase()) != -1 ||
        usuario.toLowerCase().search(objDatos.filter.toLowerCase()) != -1 ||
        ntipo.toLowerCase().search(objDatos.filter.toLowerCase()) != -1
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
      const { nombres, apellidos, idusuario, ntipo, usuario } = item;
      html += `<tr>
        <td scope="col">${index + 1}</td>
        <td scope="col">${nombres}</td>
        <td scope="col">${apellidos}</td>
        <td scope="col">${usuario}</td>
        <td scope="col">${ntipo}</td>
        <td scope="col"><button class="btn btn-primary btn-xs" onClick="editarUsuario(${
          item.idusuario
        })" ><i class="far fa-edit"></i></button>
        <button class="btn btn-danger btn-xs" onClick="eliminarUsuario(${
          item.idusuario
        })" ><i class="far fa-trash-alt"></i></button></td>
        </tr>
        
        `;
    }
  });

  tableContent.innerHTML = html;
  crearPaginacion();
}

function agregarUsuario() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}
function mostrarTabla() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  crearDatos();
}

function aplicarFiltro(e) {
  e.preventDefault();
  objDatos.filter = this.value;
  crearTabla();
}

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

function addfoto() {
  inputfoto.click();
}
function actualizarFoto(el) {
  if (el.target.files && el.target.files[0]) {
    const reader = new FileReader();
    reader.onload = (e) => {
      divfoto.innerHTML = `<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;"></img>`;
    };
    reader.readAsDataURL(el.target.files[0]);
  }
}

function guardarUsuario(e) {
  e.preventDefault();
  const formData = new FormData(miForm);
  console.log(formData);
  API.saveUser(formData)
    .then((data) => {
      if (data.success) {
        mostrarTabla();
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

function limpiarForm(op) {
  miForm.reset();
  document.querySelector("#id_usr").value = "0";
  document.querySelector("#tipo").value = "1";
  divFoto.innerHTML = "";
  if (op) {
    document.querySelector("#password").removeAttribute("required");
  } else {
    document.querySelector("#password").setAttribute("required", "true");
  }
}

function editarUsuario(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOneUser(id)
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

function mostrarDatosForm(records) {
  const { idusuario, usuario, nombres, apellidos, tipo, foto } = records;
  document.querySelector("#id_usr").value = idusuario;
  document.querySelector("#usuario").value = usuario;
  document.querySelector("#nombres").value = nombres;
  document.querySelector("#apellidos").value = apellidos;
  document.querySelector("#tipo").value = tipo;
  divfoto.innerHTML = `<img src="${foto}" class="h-100 w-100" style="object-fit:contain;"></img>`;
}

function eliminarUsuario(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el Registro",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: "No",
  })
    .then((result) => {
      if (result.isConfirmed) {
        API.deleteUser(id)
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
