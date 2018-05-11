    <?php //last commit ?>

    <script type="text/javascript" src="./js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>
    <script type="text/javascript" src='./js/functions.js'></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.parallax').parallax();
            $('select').material_select();
            $('.button-sidenav').sideNav({
                menuWidth: 300, // Default is 300
                edge: 'right', // Choose the horizontal origin
                closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                draggable: true // Choose whether you can drag to open on touch screens
            });

             $('.modal').modal();
             $('.modal1').modal('close');
        });
        </script>
