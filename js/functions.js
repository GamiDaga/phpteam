//Nombramos la función

function checkPassword(password) {
    if(password.length > 5 && (/[a-z]/.test(password))){
        if (/[A-Z]/.test(password)) {
            if ((/[0-9]/.test(password) || /\W/.test(password))) {
                return 1;
            }else { return 0; }
        }else { return 0; }
    }else { return 0; }
}

function validate(){

    //Definimos los caracteres permitidos en una dirección de correo electrónico
    var regexp = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;

    //Validamos un campo o área de texto, por ejemplo el campo nombre
    if ((document.getElementById('lastname').value.length < 1) && (!(/^[a-zA-Z-]+$/.test(document.getElementById('lastname').value)))){
        alert("El campo Apellido no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    }

    if ( (document.getElementById('name').value.length < 1) &&  !(/^[a-zA-Z-]+$/.test(document.getElementById('name').value) )  ){
        alert("El campo Nombre no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    }

    if ((document.getElementById('userName').value.length < 6) && !(/^[a-zA-Z0-9-]+$/.test(document.getElementById('userName').value)) ){
        alert("El campo Usuario no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    }

    if (document.getElementById('contraseña').value == document.getElementById('recontraseña').value) {
        checkPassword(document.getElementById('contraseña').value);
    }else {
        alert("El campo Contraseña y su repeticion no coinciden. Modifiquelo y vuelva a intentar.");
        return 0;
    }

    //Validamos un campo de texto como email
    if ( ((regexp.test(document.getElementById('email').value) == 0) || (document.getElementById('email').value.length == 0)) ){
        alert("El campo Email no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    }
    //Si todos los campos han validado correctamente, se envía el formulario
    document.form.submit();
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

    if ( (function () {

    }) || (document.getElementById('comments').value.length > 255) ){
        alert("El comentario no debe estar vacio o tener mas de 255 caracteres. Modifiquelo y vuelva a intentar.");
        return 0;
    }else {
        document.form.submit();

    }
    //document.getElementById('comments').setAttribute('value',string(document.getElementById('comments')));
}

   function validateLogin() {
       if (document.getElementById('user').length < 6 && !/^[a-zA-Z0-9-]+$/.test(document.getElementById('user'))) {
           return 0;
       }
       if (document.getElementById('password').length < 6 && !checkPassword(document.getElementById('password')))  {
           return 0;
       }
       document.form.submit();
   }

   function validateABM() {
       // ABM, update y create
       if ((document.getElementById('title') != "" &&  document.getElementById('title').length < 255 && document.getElementById('year') != "" && document.getElementById('idGenero') != "" && document.getElementById('synopsis') != "")) {
           return 0;
       }
       document.form.submit();
   }
