//Permite que solo pueda ingresar numeros en el codigo de estudiante

document.getElementById('soloNumeros').addEventListener('input', function(e) {
    //replaza todo los caracteres por nada
     this.value = this.value.replace(/[^0-9]/g, '');
});

//Valida que en nombre y apellidos solo puedan letras
function validarInput(event) {
    var codigo = event.which || event.keyCode;
        //permitir teclas de control como retroceso, tabulalación, etc.
        if (codigo == 8 || codigo == 9 || codigo == 37 || codigo == 39){
            return true;
        }
        var caracter = String.fromCharCode(codigo);
        var patron = /[a-zA-Z]/; //esta expresion permite regular solo letras
        if (!patron.test(caracter)) {
            event.preventDefault();
            return false;
        }
    }

//se encarga de que la contraeña cumpla con lo establecido
function validarPassword(){
    var password = document.getElementById("password").value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,9}$/;

    if (regex.test(password)){
        
    } else {
        window.alert("La contraseña no cumple no cumple con los requisitos: De 6-9 caracteres, 1 letra mayúscula y 1 número");
    }
}