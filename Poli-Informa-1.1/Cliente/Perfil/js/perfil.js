function formularioproducto(opcion){
    let mostrarProductos = document.getElementById('contenedor-principal');

    switch(opcion){
        case 1:
            mostrarProductos.hidden = false;
            break;
        case 2: 
            mostrarProductos.hidden = true;
            break;
    }
}