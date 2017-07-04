//Nombramos la función

function checkPassword(password) {
  if(password.length > 5){
        if (/[a-z]/.test(password)){
              if (/[A-Z]/.test(password)){
                    if (/[0-9]/.test(password) || /\W/.test(password)){
                         return true;
                    }else {
                        alert("La Contraseña debe tener al menos un numero o un simbolo. Modifiquelo y vuelva a intentar.");
                        return false;}
                }else {
                    alert("La Contraseña debe tener al menos un caracter en minuscula. Modifiquelo y vuelva a intentar.");
                    return false;}
            }else {
                alert("La Contraseña debe tener al menos un caracter en MAYUSCULA. Modifiquelo y vuelva a intentar.");
                return false;}
      }else{
          alert("La Contraseña debe tener al menos 6 digitos. Modifiquelo y vuelva a intentar.");
          return false;}
    return true;
}

function validate(){

    //Definimos los caracteres permitidos en una dirección de correo electrónico
    var regexp = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;

    //Validamos un campo o área de texto, por ejemplo el campo nombre
    if ((document.getElementById('lastname').value.length < 1) || (/\W/.test(document.getElementById('lastname').value)) || (/[0-9]/.test(document.getElementById('lastname').value))){
      alert("El campo Apellido no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
      return false;
    }

    if ((document.getElementById('name').value.length < 1) || (/\W/.test(document.getElementById('name').value)) || (/[0-9]/.test(document.getElementById('name').value))){
      alert("El campo Nombre no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
      return false;
    }

    if ((document.getElementById('userName').value.length < 6) || (/\W/.test(document.getElementById('userName').value)) ){
      alert("El campo Usuario no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
      return false;
    }
    if (document.getElementById('recontraseña').value.length != 0 && document.getElementById('recontraseña').value.length != 0) {
        if (document.getElementById('contraseña').value == document.getElementById('recontraseña').value) {
            if(!checkPassword(document.getElementById('contraseña').value)){
                return false;
            }
        }else {
            alert("El campo Contraseña y su repeticion no coinciden. Modifiquelo y vuelva a intentar.");
            return false;
        }
    }else {
        alert("El campo Contraseña o su repeticion esta vacio. Modifiquelo y vuelva a intentar.");
        return false;}

    if ( ((regexp.test(document.getElementById('email').value) == 0) || (document.getElementById('email').value.length == 0)) ){
        alert("El campo Email no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return false;
    }

}
//
// En  el  registro  deberá  haber  un  formulario  que
// *solicite  al usuario
//     -el apellido,
//     -el nombre,
//     -un nombre de usuario y
//     -una clave (que debe ingresarse dos  veces,  para  validar  del  lado  del  cliente  que  esté  bien  escrita).
// Del  formulario  se debe  validar  (tanto Del  lado  del  cliente  cómo  del  lado  del  servidor)  que
//     -el  nombre  y
//     -apellido
// no  sean  vacíos  y  que  solo  tengan  caracteres  alfabéticos,
// *que  el  nombre  de usuario  tenga  por  lo  menos
//     -6  caracteres  y
//     -que  sean  alfanuméricos  y
// que  la  clave tenga  por  los  menos
//     -6  caracteres  y
//     -que  tenga  letras  (mayúsculas  y  minúsculas)
// además de por lo menos
//     -un número o un símbolo (ej, $, @, etc).
// Del lado del servidor se debe verificar que
//     -el nombre de usuario elegido no exista previamente en la base de datos.
//

function validateComments() {

    if ( (document.getElementById('comments').value.length == 0) || (document.getElementById('comments').value.length > 255) ){
        alert("El comentario no debe estar vacio o tener mas de 255 caracteres. Modifiquelo y vuelva a intentar.");
        return false;
    }
}

function validateLogin() {
    if (document.getElementById('userNameLog').value.length < 6 || /\W/.test(document.getElementById('userNameLog').value)) {
        alert("El usuario debe contener al menos 6 caracteres alfanuméricos (a-z A-Z 0-9)")
        return false;
    }
    if (document.getElementById('contraseñaLog').value.length = 0){
        alert("El campo Contraseña esta vacio.");
        return false;
    }else if (!checkPassword(document.getElementById('contraseñaLog').value)){
            return false;
    }
}


function validateABMupdate() {
  // ABM, update y create
    if (document.getElementById('title').value == "" || document.getElementById('title').value.length > 255){
        alert("El titulo no debe estar vacio o tener mas de 255 caracteres. Modifiquelo y vuelva a intentar.");
        return false;
    }
    if(document.getElementById('year').value == "" ){
        alert("El año no debe estar vacio . Modifiquelo y vuelva a intentar.");
        return false;
    }
    if(document.getElementById('idGenero').value == "" ){
        alert("El genero no debe estar vacio. Modifiquelo y vuelva a intentar.");
        return false;

    }
    if(document.getElementById('synopsis').value == ""){
        alert("La sinopsis no debe estar vacio. Modifiquelo y vuelva a intentar.");
        return false;
    }
}

function validateImage(obj){
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        document.getElementById('image').value = "";
        return false;
    }

    if (!(/\.(jpg|png|gif|jpeg)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen o su extension es incompatible');
        document.getElementById('image').value = "";
        return false;
    }

    if (uploadFile.size > 16777216){
        alert('El peso de la imagen no puede exceder los 16mb')
        document.getElementById('image').value = "";
        return false;
    }
    if (uploadFile.size == 0){
        alert('Debe subir una imagen');
        document.getElementById('image').value = "";
        return false;
    }
}

function validateABMcreate() {
  // ABM, update y create
    if (document.getElementById('title').value == "" || document.getElementById('title').value.length > 255){
        alert("El titulo no debe estar vacio o tener mas de 255 caracteres. Modifiquelo y vuelva a intentar.");
        return false;
    }
    if(document.getElementById('year').value == "" ){
        alert("El año no debe estar vacio . Modifiquelo y vuelva a intentar.");
        return false;
    }
    if(document.getElementById('idGenero').value == "" ){
        alert("El genero no debe estar vacio. Modifiquelo y vuelva a intentar.");
        return false;

    }
    if(document.getElementById('synopsis').value == ""){
        alert("La sinopsis no debe estar vacio. Modifiquelo y vuelva a intentar.");
        return false;
    }

    if (document.getElementById('image').value == 0) {
        alert("Debe subir una imagen.");
        return false;
    }
}
