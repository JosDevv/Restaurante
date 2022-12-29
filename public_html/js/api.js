const BASE_API = "/Restaurante/";

class Api {
  /**
   * Toma un formulario, lo envía al servidor y devuelve la respuesta.
   * @param form - Los datos del formulario que se enviarán al servidor.
   * @returns Los datos están siendo devueltos.
   */
  async validarLogin(form) {
    const query = await fetch(`${BASE_API}Login/validar`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  /**
   * Carga datos desde la API.
   * @returns Los datos de la API
   */
  async loadData() {
    const query = await fetch(`${BASE_API}Usuarios/getAll`);
    const data = await query.json();
    return data;
  }
  /**
   * Obtiene los datos de la API y los devuelve como un objeto JSON
   * @returns Los datos están siendo devueltos.
   */
  async loadRestaurantes() {
    const query = await fetch(`${BASE_API}Restaurantes/getAllRestaurantes`);

    const data = await query.json();

    return data;
  }
  /**
   * Carga todos los productos de la base de datos.
   * @returns Los datos de la API
   */
  async loadProductos() {
    const query = await fetch(`${BASE_API}Productos/getAllProductos`);
    const data = await query.json();
    return data;
  }
  /**
   * Toma un formulario, lo envía al servidor y devuelve la respuesta.
   * @param form - Los datos del formulario que se enviarán al servidor.
   * @returns Los datos que se devuelven son los datos que se envían al servidor.
   */
  async saveUser(form) {
    const query = await fetch(`${BASE_API}Usuarios/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

  /**
   * Envía una solicitud POST al servidor, que luego guarda el restaurante en la base de datos.
   * @param form - Los datos del formulario que se enviarán al servidor.
   * @returns Los datos de la API
   */
  async saveRestaurante(form) {
    const query = await fetch(`${BASE_API}Restaurantes/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

/**
 * Toma un formulario, lo envía a la API y devuelve los datos
 * @param form - Los datos del formulario que se enviarán al servidor.
 * @returns Los datos de la API
 */
  async saveProducto(form) {
    const query = await fetch(`${BASE_API}Productos/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

/**
 * Toma un formulario, lo envía a la API y devuelve los datos
 * @param form - Los datos del formulario que se enviarán al servidor.
 * @returns Los datos que se devuelven son los datos que se envían al servidor.
 */
  async saveIngrediente(form) {
    const query = await fetch(`${BASE_API}Productos/saveI`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

/**
 * Obtiene un usuario de la API y devuelve los datos.
 * @param id - El id del usuario que desea obtener.
 * @returns La información del usuario.
 */
  async getOneUser(id) {
    const query = await fetch(`${BASE_API}Usuarios/getOneUser?id=${id}`);
    const data = await query.json();
    return data;
  }
/**
 * Obtiene los datos de la API y los devuelve como un objeto JSON
 * @param id - La identificación del restaurante que desea obtener.
 * @returns Los datos de la consulta.
 */

  async getOneRestaurante(id) {
    const query = await fetch(
      `${BASE_API}Restaurantes/getOneRestaurante?id=${id}`
    );
    const data = await query.json();
    return data;
  }

/**
 * Obtiene los datos de la API y los devuelve como un objeto JSON
 * @param id - El id del producto que desea obtener.
 * @returns Los datos de la API.
 */
  async getOneProducto(id) {
    const query = await fetch(`${BASE_API}Productos/getOneProductos?id=${id}`);
    const data = await query.json();
    return data;
  }

  /**
   * Toma una identificación como parámetro, realiza una solicitud de búsqueda a la API y devuelve los
   * datos
   * @param id - El id del usuario que desea eliminar.
   * @returns Los datos de la consulta.
   */
  async deleteUser(id) {
    const query = await fetch(`${BASE_API}Usuarios/deleteUser?id=${id}`);

    const data = await query.json();
    return data;
  }

  /**
   * Elimina un restaurante de la base de datos
   * @param id - El id del restaurante que se va a eliminar.
   * @returns Los datos de la consulta.
   */
  async deleteRestaurante(id) {
    const query = await fetch(
      `${BASE_API}Restaurantes/deleteRestaurante?id=${id}`
    );

    const data = await query.json();
    return data;
  }
/**
 * Toma una identificación como parámetro, luego realiza una solicitud de búsqueda a la API y luego
 * devuelve los datos.
 * @param id - El id del producto que se va a eliminar.
 * @returns Los datos están siendo devueltos.
 */
  async deleteProducto(id) {
    const query = await fetch(`${BASE_API}Productos/deleteProductos?id=${id}`);

    const data = await query.json();
    return data;
  }
}
