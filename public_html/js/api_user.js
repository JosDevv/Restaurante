const BASE_API='/Restaurante/';

class Api{
/**
 * Envía una solicitud POST al servidor con los datos del formulario y devuelve la respuesta.
 * @param form - Los datos del formulario que se enviarán al servidor.
 * @returns Los datos están siendo devueltos.
 */
    async validarLogin(form){
        const query=await fetch(`${BASE_API}Login/validar`,{
            method:"POST",
            body:form,
        });
        const data=await query.json();
        return data;
    }
/**
 * Obtiene los datos de la API y los devuelve como un objeto JSON
 * @returns Los datos de la API
 */
    async loadRestaurantes(){
        const query=await fetch(`${BASE_API}Main/getAllRestaurantes`);
        
        const data=await query.json();
      
        return data;
    }


}