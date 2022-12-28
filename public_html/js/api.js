const BASE_API='/Restaurante/';

class Api{
    async validarLogin(form){
        const query=await fetch(`${BASE_API}Login/validar`,{
            method:"POST",
            body:form,
        });
        const data=await query.json();
        return data;
    }
    async loadData(){
        const query=await fetch(`${BASE_API}Usuarios/getAll`);
        const data=await query.json();
        return data;
    }
    async loadRestaurantes(){
        const query=await fetch(`${BASE_API}Restaurantes/getAllRestaurantes`);
        
        const data=await query.json();
        console.log(data);
        return data;
    }
    async loadCategorias(){
        const query=await fetch(`${BASE_API}Restaurantes/getAllCategorias`);
        const data=await query.json();
        return data;
    }
    async loadAutores(){
        const query=await fetch(`${BASE_API}Restaurantes/getAllAutores`);
        const data=await query.json();
        return data;
    }
    async saveUser(form){
        const query=await fetch(`${BASE_API}Usuarios/save`,{
            method:"POST",
            body:form,
        });
        const data=await query.json();
        return data;
    }

    async saveRestaurante(form){
        const query=await fetch(`${BASE_API}Restaurantes/save`,{
            method:"POST",
            body:form,
        });
        const data=await query.json();
        return data;
    }

    async getOneUser(id){
        const query=await fetch(`${BASE_API}Usuarios/getOneUser?id=${id}`);
        const data=await query.json();
        return data;
    }
    
    async getOneRestaurante(id){
        const query=await fetch(`${BASE_API}Restaurantes/getOneRestaurante?id=${id}`);
        const data=await query.json();
        return data;
    }

    async deleteUser(id){
        const query=await fetch(`${BASE_API}Usuarios/deleteUser?id=${id}`);
   
        const data=await query.json();
        return data;
    }

    async deleteRestaurante(id){
        const query=await fetch(`${BASE_API}Restaurantes/deleteRestaurante?id=${id}`);
        
        const data=await query.json();
        return data;
    }

}