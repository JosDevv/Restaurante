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
    async loadRestaurantes(){
        const query=await fetch(`${BASE_API}Main/getAllRestaurantes`);
        
        const data=await query.json();
        console.log(data);
        return data;
    }


}