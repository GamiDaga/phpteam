<?php
    require_once('./layout.php');
 ?>

<body>
    <div class="contenedor">

        <div class="parallax-container">
            <div class="parallax"><img src="./images/background.jpg"></div>
        </div>
            <div class="section white">
                <div class="row container">
                <h2 class="header">Parallax</h2>
                <p class="grey-text text-darken-3 lighten-3">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p>
                </div>
            </div>
            <div class="parallax-container">
                <div class="parallax"><img src="images/parallax2.jpg"></div>
        </div>

</body>

<footer>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.parallax').parallax();
        });
    </script>

</footer>
