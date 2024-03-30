
function archivoSeleccionado(event) {

    const archivo = event.target.files[0];
    let nombreArchivo = document.getElementById('nombreArchivo');

    if (archivo) {
        nombreArchivo.value = archivo.name;
    }

}//FIN FUNCIÓN


function mostrarArchivoEnEditar(event) {

    const archivo = event.target.files[0];
    let nombreArchivo = document.getElementById('nombre-archivo');

    if (archivo) {
        nombreArchivo.value = archivo.name;
    }

}//FIN FUNCIÓN

function opcionAdministrador(opcion){

    let mostrarProductos = document.getElementById('mostrarProductos');
    let mostrarVendedores = document.getElementById('mostrarVendedores');

    switch(opcion){

        case 1:
            mostrarVendedores.hidden = true;
            mostrarProductos.hidden = false;
            break;
        case 2: 
            mostrarProductos.hidden = true;
            mostrarVendedores.hidden = false;
            break;

    }

}

function mostrarArchivoAgregarVendedor(event){
    const archivo = event.target.files[0];
    let nombreArchivo = document.getElementById('rutaFotoVendedor');
    if(archivo){
        nombreArchivo.value = archivo.name;
    }
}

function mostrarArchivoEditarVendedor(event){
    const archivo = event.target.files[0];
    let nombreArchivo = document.getElementById('fotoEditarVendedor');
    if(archivo){
        nombreArchivo.value = archivo.name;
    }
}

function modalEditarVendedor(){
    const abrirModal = document.querySelector(".modal_abrir");
    const modal = document.querySelector(".modal_editar_vendedor");
    const cerrarModal = document.querySelector(".modal_cerrar");
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add("modal--show");

    });

    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove("modal--show");
    });
    
}

function modalAgregarVendedor(){

    const abrirModal = document.querySelector('.modal_abrir_agregar_vendedor');
    const modal = document.querySelector('.modal_agregar_vendedor');
    const cerrarModal = document.querySelector('.modal_cerrar_agregar_vendedor');

    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add("modal--show--agregar--vendedor");
    });
    
    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove("modal--show--agregar--vendedor");
    });
    
}

function modalEditarVendedor(id, codigo, nombre, descripcion, correo, telefono, inicio, fin, foto){

    let IdVendedor = document.getElementById('IdEditarVendedor');
    let codigoVendedor = document.getElementById('codigoEditarVendedor');
    let nombreVendedor = document.getElementById('nombreEditarVendedor'); 
    let descripcionVendedor = document.getElementById('descripcionEditarVendedor'); 
    let correoVendedor = document.getElementById('correoEditarVendedor'); 
    let telefonoVendedor = document.getElementById('telefonoEditarVendedor'); 
    let inicioVendedor = document.getElementById('horaInicioEditarVendedor'); 
    let finVendedor = document.getElementById('horaFinEditarVendedor'); 
    let fotoVendedor = document.getElementById('fotoEditarVendedor'); 
    IdVendedor.value = id;
    codigoVendedor.value = codigo;
    nombreVendedor.value = nombre;
    descripcionVendedor.value = descripcion;
    correoVendedor.value = correo;
    telefonoVendedor.value = telefono;
    inicioVendedor.value = inicio;
    finVendedor.value = fin;
    fotoVendedor.value = foto;

    const abrirModal = document.querySelector(`.modal_abrir_editar_vendedor_${id}`);
    const modal = document.querySelector(".modal_editar_vendedor");
    const cerrarModal = document.querySelector(".modal_cerrar_editar_vendedor");
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add("modal--show");

    });

    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove("modal--show");
    });
    
}

function modalBorrarVendedor(id, foto){

    let idVendedor = document.getElementById('idEliminarVendedor');
    let fotoVendedor = document.getElementById('fotoEliminarVendedor');
    
    idVendedor.value = id;
    fotoVendedor.value = foto;

    const abrirModal = document.querySelector(`.modal_abrir_borrar_vendedor_${id}`);
    const modal = document.querySelector('.modal_borrar_vendedor');
    const cerrarModal = document.querySelector('.modal_cerrar_borrar_vendedor');
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add("modal--show--borrar--vendedor");
    });
    
    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove("modal--show--borrar--vendedor");
    });
}



