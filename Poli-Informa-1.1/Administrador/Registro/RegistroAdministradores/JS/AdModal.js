function mostrar(){
    let abrir = document.querySelector('.btn_abrir');
    let modal = document.querySelector('.modal');
    let cerrar = document.querySelector('.btn_cerrar');
    abrir.addEventListener("click", ()=>{
        modal.classList.add('enseñar_modal');
    });
    cerrar.addEventListener("click", ()=>{
        modal.classList.remove('enseñar_modal');
    });
}