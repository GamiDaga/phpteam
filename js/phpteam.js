//Nombramos la función
function validate(){

    //Definimos los caracteres permitidos en una dirección de correo electrónico
    var regexp = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;

    //Validamos un campo o área de texto, por ejemplo el campo nombre
    if ((document.form.lastname.value.length < 1) && (!(/^[a-zA-Z-]+$/.test(document.form.lastname.value)))){
        alert("El campo Apellido no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        document.form.lastname.focus();
        return 0;
    }

    if ((document.form.name.value.length < 1) && (!(/^[a-zA-Z-]+$/.test(document.form.name.value)))){
        alert("El campo Nombre no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        document.form.name.focus();
        return 0;
    }

    if ((document.form.user.value.length < 6) && (!(/^[a-zA-Z0-9]+$/.test(document.form.user.value)))){
        alert("El campo Nombre de Usuario no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        document.form.user.focus();
        return 0;
    }

    if (!document.form.password.value == document.form.repassword.value) {
        if((document.form.password.length > 5) && (!(/[a-z]/.test(document.form.password))) && (!(/[A-Z]/.test(document.form.password))) && (!(/[0-9]|\W/.test(document.form.password))) ) {
            alert("El campo Contraseña no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
            document.form.password.focus();
            return 0;
        }

        if((document.form.repassword.length > 5) && (!(/[a-z]/.test(document.form.password))) && (!(/[A-Z]/.test(document.form.password))) && (!(/[0-9]|\W/.test(document.form.password))) ) {
            alert("El campo Contraseña no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
            document.form.repassword.focus();
            return 0;
        }
    }else {
        alert("El campo Contraseña y su repeticion no coinciden. Modifiquelo y vuelva a intentar.");
        document.form.password.focus();
        document.form.repassword.focus();
    }

    //Validamos un campo de texto como email
    if ((regexp.test(document.form.email.value) == 0) || (document.form.email.value.length == 0)){
        alert("El campo Email no coincide con lo esperado. Modifiquelo y vuelva a intentar.");
        document.form.email.focus();
        return 0;
    } else {
        var c_email=true;
    }

    //Si todos los campos han validado correctamente, se envía el formulario
    document.form.submit();
}


<!--
   En  el  registro  deberá  haber  un  formulario  que
   *solicite  al usuario
       -el apellido,
       -el nombre,
       -un nombre de usuario y
       -una clave (que debe ingresarse dos  veces,  para  validar  del  lado  del  cliente  que  esté  bien  escrita).
   Del  formulario  se debe  validar  (tanto Del  lado  del  cliente  cómo  del  lado  del  servidor)  que
       -el  nombre  y
       -apellido
   no  sean  vacíos  y  que  solo  tengan  caracteres  alfabéticos,
   *que  el  nombre  de usuario  tenga  por  lo  menos
       -6  caracteres  y
       -que  sean  alfanuméricos  y
   que  la  clave tenga  por  los  menos
       -6  caracteres  y
       -que  tenga  letras  (mayúsculas  y  minúsculas)
   además de por lo menos
       -un número o un símbolo (ej, $, @, etc).
   Del lado del servidor se debe verificar que
       -el nombre de usuario elegido no exista previamente en la base de datos.

-->
