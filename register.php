<?php
//last commit
    require_once('./sql/connect.php');
    require_once('./sql/query.php');
    require_once('./layout/head.php');
 ?>

 <body>
     <header>
         <?php
        echo "<header>";
            require_once('./layout/header.php');
        echo "</header>";
         $link = connect();
         ?>
     </header>


     <div class="contenedor ">



         <div class="container">
             <div class="row formulario-registro">
                 <h1>Registro</h1>

                 <form class="col s12" action="./ABM.php" method="post" onsubmit="return validate(this)">

                     <input type="hidden" name="operation" value="register">

                     <div class="row campo white">
                         <div class="input-field col s10 m5 l6">
                             <input id="lastname" type="text" name="lastname" >
                             <label for="lastname">Apellido</label>
                         </div>

                         <div class="input-field col s10 m5 l6">
                             <input id="name" type="text" name="name" >
                             <label for="name">Nombre</label>
                         </div>
                         <div class="campo-aclaracion">
                             <p>Solo caracteres alfabéticos (a-z A-Z)</p>
                         </div>

                     </div>
                     <div class="row campo white">
                         <div class="input-field col s10 m5 l6">
                             <input id="userName" type="text" name="userName" >
                             <label for="userName">Usuario</label>
                         </div>
                         <div class="campo-aclaracion">
                             <p>Debe contener al menos 6 caracteres alfanuméricos (a-z A-Z 0-9)</p>
                         </div>
                     </div>
                     <div class="row campo white">
                         <div class="input-field col s10 m5 l6">
                             <input id="contraseña" type="password" name="contraseña" >
                             <label for="contraseña">Contraseña</label>
                         </div>
                         <div class="campo-aclaracion">
                             <p> Debe contener al menos 6 caracteres, una letra mayúscula, una minúscula y un número o un símbolo (ej: $, @, etc).</p>
                         </div>
                     </div>
                     <div class="row campo white">
                         <div class="input-field col s10 m5 l6">
                             <input id="recontraseña" type="password" name="recontraseña" >
                             <label for="recontraseña">Re-Contraseña</label>
                         </div>

                     </div>
                     <div class="row campo white">
                         <div class="input-field col s10 m10 l10 inline">
                             <input id="email" type="email" name="email">
                             <label for="email" data-error="wrong" data-success="right">Email</label>
                         </div>
                     </div>
                     <input type="submit" value="Registrarse" id="enviar" class="btn btn-submit"/> <!-- onclick="validate()" -->
                 </form>
             </div>

         </div>
     </div>
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

     </div>

     <footer>
         <?php
         require_once('./layout/footer.php');
          ?>
     </footer>
</body>
