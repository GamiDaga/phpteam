<head>
    <!--Importacion de Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!---->
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css"  media="screen,projection"/>
    <!-- Importcion de hoja de estilos propia -->
    <link rel="stylesheet" href="./css/stylesheet.css">

    <link rel="shortcut icon" href="./images/icon.png">
</head>

<body>

    <nav>
        <div class="gris-1">

            <div class="nav-wrapper">
                <a href="#!" class="brand-logo"><img class="icon" src="./images/icon.png" alt=""></a>

                <ul class="right">
                    <li><a href="#" data-activates="slide-out" class="button-sidenav"><i class="material-icons">input</i></a></li>
                </ul>

                <ul class="right hide-on-med-and-down">
                    <div class="nav-wrapper">
                      <form>
                        <div class="input-field">
                          <input id="search" type="search" required>
                          <label class="label-icon" for="search">
                              <i class="material-icons">search</i></label>
                          <i class="material-icons">close</i>
                        </div>
                    </form>
                </ul>

                <ul id="slide-out" class="side-nav">
                    <li>
                        <div class="userView">
                            <div class="background">
                                <img src="./images/backgroundsidenav.png">
                            </div>
                            <!-- <a href="#!user"><img class="circle" src="images/yuna.jpg"></a> -->
                            <a href="#!name"><span class="white-text name">John Doe</span></a>
                        <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
                        </div>
                    </li>
                    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
                    <li><a href="#!">Second Link</a></li>
                    <li><div class="divider"></div></li>
                    <li><a class="subheader">Subheader</a></li>
                    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
                </ul>
            </div>
        </div>

    </nav>





    <footer>
        <script type="text/javascript" src="./js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.parallax').parallax();

                $('.button-sidenav').sideNav({
                    menuWidth: 300, // Default is 300
                    edge: 'right', // Choose the horizontal origin
                    closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                    draggable: true // Choose whether you can drag to open on touch screens
                });
            });
            </script>
    </footer>
</body>
