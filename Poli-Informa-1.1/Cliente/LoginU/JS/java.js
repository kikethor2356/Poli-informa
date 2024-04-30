document.addEventListener("DOMContentLoaded", function() {
    let contraseña = document.getElementById('AluPassword');
    let verContraseña = document.getElementById('link_ver_contraseña');
    verContraseña.addEventListener("mousedown", ()=>{
        contraseña.type = "text";
    });
    verContraseña.addEventListener("mouseup", ()=>{
        contraseña.type = "password";
    }); 
})

function mostrarInicioSesion(){
    let contenedor = document.querySelector('.contenedor_inicio_sesion');
    //AGREGA LA CLASE QUE MUESTRA EL CONTENEDOR DE INICIO DE SESIÓN
    contenedor.classList.add('mostrar_contenedor');    
}

//MUESTRA EL INICIO DE SESIÓN DESPUÉS DE x SEGUNDOS
setTimeout(mostrarInicioSesion, 1000);