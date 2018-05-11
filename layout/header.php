

<?php
//last commit
    session_start();
 ?>

<nav >
    <div class="gris-1" >

        <div class="nav-wrapper"  >
            <a href="./index.php" class="logo"><img class="icon" src="./images/icon.png" alt=""></a>
            <?php if (isset($_SESSION['log']) && ($_SESSION['log'] == true)): ?>
                <ul class="right">
                    <li><a href="#" data-activates="slide-out" class="button-sidenav"><i class="material-icons">account_circle</i></a></li>
                </ul>
            <?php endif; ?>

            <?php if (!isset($_SESSION['log']) || ($_SESSION['log'] == false)): ?>

                <!-- Modal Trigger -->
                <ul class="right">
                    <li class="marco-space">
                        <button data-target="modal1" class="btn">Login</button>
                    </li>
                    <li class="marco-space">
                        <a href="./register.php" class="btn">Registrarse</a>
                    </li>
                </ul>

                <!-- Modal Structure -->
                <div id="modal1" class="modal campo bottom-sheet">
                    <form class="" action="session.php" method="post" onsubmit="return validateLogin(this)">
                        <div class="modal-content">
                            <h4>Login</h4>
                            <p>Ingrese los siguientes datos.</p>

                            <div class="row campo white">
                                <div class="input-field col s10 m5 l6">
                                    <input id="userNameLog" type="text" name="userNameLog" class="validate">
                                    <label for="userNameLog">Usuario</label>
                                </div>

                                <div class="input-field col s10 m5 l6">
                                    <input id="contraseñaLog" type="password" name="contraseñaLog" class="validate">
                                    <label for="contraseñaLog">Contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-default marco-space">Login</button>
                            <button type="button" class="waves-effect waves-green btn-flat modal-action modal-close marco-space">Cerrar</button>
                        </div>
                    </form>
                </div>

            <?php endif; ?>


            <!-- <ul class="right hide-on-med-and-down">
                <div class="nav-wrapper" >
                    <form>
                        <div class="input-field">
                            <input id="search" type="search" required>
                      <label class="label-icon" for="search">
                          <i class="material-icons">search</i></label>
                      <i class="material-icons">close</i>
                    </div>
                </form>
            </ul> -->

            <?php
            if (isset($_SESSION['log']) && ($_SESSION['log'] == true)):

                $name = $_SESSION['name'];
                $lastname = $_SESSION['lastname'];
                $userName = $_SESSION['userName'];
                $email = $_SESSION['email'];
                $admin = $_SESSION['admin'];
            ?>

                <ul id="slide-out" class="side-nav gray">
                    <li>
                        <div class="userView">
                            <div class="background" >
                                <img src="./images/backgroundsidenav.png" >
                            </div>
                            <!-- <a href="#!user"><img class="circle" src="images/yuna.jpg"></a> -->
                            <span class="white-text name"><?php $_SESSION['name'];?></span>
                        <a href="#"><span class="gray-text email"><?php $_SESSION['email']; ?></span></a>
                        </div>
                    </li>
                    <li><a href="#!"><i class="material-icons">cloud</i>Bienvenido</a></li>
                    <li><a href="#!"><?php echo $userName ?></a></li>
                    <li><a class="subheader"><?php echo $name ?></a></li>
                    <li><a class="subheader"><?php echo $lastname ?></a></li>
                    <li><div class="divider"></div></li>
                    <li><a class="waves-effect" href="#!"> <?php echo $email ?></a></li>
                    <form class="" action="./sessionout.php" method="post">
                        <button type="submit" name='logout' value="true"class="waves-effect waves-green btn-flat marco-space right hide-on-med-and-down">Logout</button>
                    </form>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>


<div class="parallax-container">
    <div class="parallax"><img src="./images/background.jpg"></div>
</div>