<?php

require_once "./config/app.php";

require_once "./app/views/inc/session_start.php";

    if (isset($_GET['views'])) {
        $url = explode("/", $_GET['views']);
    } else {
        $url = ["login"];
    }

    echo $url[1];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    require_once "./app/views/inc/head.php";
    ?>
</head>

<body>

    <!-- Main container -->
    <main class="page-container">
        <!-- Barra de navegación lateral-->
        <?php
        require_once "./app/views/inc/navLateral.php";
        ?>

        <!-- Page content -->
        <section class="full-width pageContent scroll" id="pageContent">
            <!-- Barra de navegación superior-->
            <?php
            require_once "./app/views/inc/navBar.php";
            ?>
        </section> <!-- Fin page content -->

    </main> <!-- Fin main container -->
    <?php
    require_once "./app/views/inc/script.php";
    ?>
</body>

</html>