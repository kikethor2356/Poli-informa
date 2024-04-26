
function archivoSeleccionado(event) {

    const archivo = event.target.files[0];
    let nombreArchivo = document.getElementById('nombreArchivo');

    if (archivo) {
        nombreArchivo.value = archivo.name;
    }

}//FIN FUNCIÓN


function mostrarArchivoEnEditar(event) {

    const archivo = event.target.files[0];
    let nombreArchivo = document.getElementById('rutaArchivoEditarProducto');

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

function modalAgregarProducto(){

    const abrirModal = document.querySelector('.modal_abrir_agregar_producto');
    const modal = document.querySelector('.modal_agregar_producto');
    const cerrarModal = document.querySelector('.modal_cerrar_agregar_producto');
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add('modal--show--agregar--producto');
    });
    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove('modal--show--agregar--producto');
    });

}

function modalEditarProducto(id, nombre, codigo, precio, descripcion, nombreImagen, categoria){

    let idProducto = document.getElementById('idEditarProducto');
    let nombreProducto = document.getElementById('nombreEditarProducto');
    let codigoProducto = document.getElementById('vendedorEditarProducto');
    let precioProducto = document.getElementById('precioEditarProducto');
    let descripcionProducto = document.getElementById('descripcionEditarProducto');
    let nombreImagenProducto = document.getElementById('rutaArchivoEditarProducto');
    let categoriaProducto = document.getElementById('comboBoxCategoriaEditarProducto');
    idProducto.value = id;
    nombreProducto.value = nombre;
    codigoProducto.value = codigo;
    precioProducto.value = precio;
    descripcionProducto.value = descripcion;
    nombreImagenProducto.value = nombreImagen;
    categoriaProducto.value = categoria;

    const abrirModal = document.querySelector(`.modal_abrir_editar_producto_${id}`);
    const modal = document.querySelector('.modal_editar_producto');
    const cerrarModal = document.querySelector('.modal_cerrar_editar_producto');
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add('modal--show--editar--producto');
    });

    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove('modal--show--editar--producto');
    });

}

function modalBorrarProducto(id, foto){
    
    let idProducto = document.getElementById('idEliminarProducto');
    let fotoProducto = document.getElementById('archivoEliminarProducto');

    idProducto.value = id;
    fotoProducto.value = foto;

    const abrirModal = document.querySelector(`.modal_abrir_borrar_producto_${id}`);
    const modal = document.querySelector('.modal_borrar_producto');
    const cerrarModal = document.querySelector('.modal_cerrar_borrar_producto'); 
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add("modal--show--borrar--producto"); 
    });
    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove("modal--show--borrar--producto");
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



// Vendedor pendiente
function modalVerVendedorPendiente(id, codigo, nombre, descripcion, correo, telefono, horaInicio, horaFin, foto){

    let codigoVendedor = document.getElementById('codigoVerVendedorPendiente');
    let nombreVendedor = document.getElementById('nombreVerVendedorPendiente');
    let descripcionVendedor = document.getElementById('descripcionVerVendedorPendiente');
    let correoVendedor = document.getElementById('correoVerVendedorPendiente');
    let telefonoVendedor = document.getElementById('telefonoVerVendedor');
    let horaInicioVendedor = document.getElementById('horaInicioVendedorPendiente');
    let horaFinVendedor = document.getElementById('horaFinVendedorPendiente');
    let fotoVendedor = document.getElementById('imagenVendedorPendiente');

    codigoVendedor.value = codigo;
    nombreVendedor.value = nombre;
    descripcionVendedor.value = descripcion;
    correoVendedor.value = correo;
    telefonoVendedor.value = telefono;
    horaInicioVendedor.value = horaInicio;
    horaFinVendedor.value = horaFin;
    fotoVendedor.src = "PHP/imagenes/" + foto;
    
    const abrirModal = document.querySelector(`.modal_abrir_ver_vendedor_pendiente_${id}`);
    const modal = document.querySelector(".modal_ver_vendedor_pendiente");
    const cerrarModal = document.querySelector(".modal_cerrar_ver_vendedor_pendiente");
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add("modal--show--ver--vendedor--pendiente");
    });
    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove("modal--show--ver--vendedor--pendiente");
    });
}

function modalBorrarVendedorPendiente(id, foto){

    let idVendedor = document.getElementById('idEliminarVendedorPendiente');
    let fotoVendedor = document.getElementById('fotoEliminarVendedorPendiente');

    idVendedor.value = id;
    fotoVendedor.value = foto;

    const abrirModal = document.querySelector(`.modal_abrir_borrar_vendedor_pendiente_${id}`);
    const modal = document.querySelector('.modal_borrar_vendedor_pendiente');
    const cerrarModal = document.querySelector('.modal_cerrar_borrar_vendedor_pendiente');
    abrirModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.add("modal--show--borrar--vendedor--pendiente");
    });
    
    cerrarModal.addEventListener("click", (e)=>{
        e.preventDefault();
        modal.classList.remove("modal--show--borrar--vendedor--pendiente");
    });

}

function modalAceptarVendedorPendiente(id){
    
    let idVendedor = document.getElementById('idAceptarVendedorPendiente');
    idVendedor.value = id;
    
    console.log(id);
    const abrirModal = document.querySelector(`.modal_abrir_aceptar_vendedor_pendiente_${id}`);
    const modal = document.querySelector(".modal_aceptar_vendedor_pendiente");
    const cerrarModal = document.querySelector(".modal_cerrar_aceptar_vendedor_pendiente");
    abrirModal.addEventListener("click", ()=>{
        modal.classList.add("modal--show--aceptar--vendedor--pendiente");
    });
    cerrarModal.addEventListener("click", ()=>{
        modal.classList.remove("modal--show--aceptar--vendedor--pendiente");
    });
    
}