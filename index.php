<?php

require_once "./config/app.php";

require_once "./autoload.php";

require_once "./app/views/inc/session_start.php";

if (isset($_GET['views'])) {
    $url = explode("/", $_GET['views']);
} else {
    $url = ["login"];
}
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <?php
        require_once "./app/views/inc/head.php";
        ?>
    </head>

    <body>
        <?php
        
        use app\controllers\viewsController;

        $viewsController = new viewsController();
        $vista = $viewsController->obtenerVistaControlador($url[0]);

        if ($vista == "login" || $vista == "404") {
            require_once "./app/views/content/". $vista."-view.php";
        } else {

        ?>

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

                    require_once $vista;
                    ?>
                </section> <!-- Fin page content -->

            </main> <!-- Fin main container -->
        <?php
        }
        require_once "./app/views/inc/script.php";
        ?>
    </body>

</html>