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
    async loadLibros(){
        const query=await fetch(`${BASE_API}Libros/getAllLibros`);
        
        const data=await query.json();
        console.log(data);
        return data;
    }
    async loadCategorias(){
        const query=await fetch(`${BASE_API}Libros/getAllCategorias`);
        const data=await query.json();
        return data;
    }
    async loadAutores(){
        const query=await fetch(`${BASE_API}Libros/getAllAutores`);
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
// no sirve
    async saveLibro(form){
        const query=await fetch(`${BASE_API}Libros/save`,{
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
    
    async deleteUser(id){
        const query=await fetch(`${BASE_API}Usuarios/deleteUser?id=${id}`);
        console.log("aqui es");
        const data=await query.json();
        return data;
    }

}