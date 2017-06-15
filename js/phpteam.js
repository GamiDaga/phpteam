//Nombramos la función
function validate(){

    //Definimos los caracteres permitidos en una dirección de correo electrónico
    var regexp = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;

    //Validamos un campo o área de texto, por ejemplo el campo nombre
    if ((document.getElementById('lastname').value.length < 1) && (!(/^[a-zA-Z-]+$/.test(document.getElementById('lastname').value)))){
        alert("El campo Apellido no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    }

    if ((document.getElementById('name').value.length < 1) && (!(/^[a-zA-Z-]+$/.test(document.getElementById('name').value)))){
        alert("El campo Nombre no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    }

    if ((document.getElementById('user').value.length < 6) && (!(/^[a-zA-Z0-9]+$/.test(document.getElementById('user').value)))){
        alert("El campo Nombre de Usuario no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    }

    if (!document.getElementById('password').value == document.getElementById('repassword').value) {
        if((document.getElementById('password').length > 5) && (!(/[a-z]/.test(document.getElementById('password')))) && (!(/[A-Z]/.test(document.getElementById('password')))) && (!(/[0-9]|\W/.test(document.getElementById('password')))) ) {
            alert("El campo Contraseña no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
            return 0;
        }

        if((document.getElementById('repassword').length > 5) && (!(/[a-z]/.test(document.getElementById('password')))) && (!(/[A-Z]/.test(document.getElementById('password')))) && (!(/[0-9]|\W/.test(document.getElementById('password')))) ) {
            alert("El campo Contraseña no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
            return 0;
        }
    }else {
        alert("El campo Contraseña y su repeticion no coinciden. Modifiquelo y vuelva a intentar.");
    }

    //Validamos un campo de texto como email
    if ((regexp.test(document.getElementById('email').value) == 0) || (document.getElementById('email').value.length == 0)){
        alert("El campo Email no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        return 0;
    } else {
        var c_email=true;
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
