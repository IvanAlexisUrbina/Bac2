<?php
include_once '../config/helpers.php';
use function Helpers\generateUrl;
    // Evitar caché en el navegador
    header("Cache-Control: private, no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Evitar caché en proxies compartidos
    header("Cache-Control: no-store, no-cache, must-revalidate, proxy-revalidate");

    // Evitar caché en versiones antiguas de Internet Explorer
    header("Cache-Control: post-check=0, pre-check=0", false);

    // Cabecera de Vary
    header("Vary: *");

    // Cabecera de Last-Modified
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

    // Cabecera de ETag
    header("ETag: " . md5(rand()));
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Login</title>

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="../assets/css/demo.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css">
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <style type="text/css">
    .layout-menu-fixed .layout-navbar-full .layout-menu,
    .layout-page {
        padding-top: 0px !important;
    }

    .content-wrapper {
        padding-bottom: 0px !important;
    }
    </style>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>

    <link href="css/login.css" rel="stylesheet">

</head>


<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img style="width:250px;" id="logoSideBar" src="img/logo_prueba.jpg" alt=""
                                        srcset="">
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->

                        <h1 class="codediv text-center">Código de validación</h1>

                        <form action="<?= generateUrl("Access","Access","UserAccess",[],"ajax"); ?>" method="post"
                            id="loginForm">

                            <div class="hide">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="text" class="form-control" name="u_email" id="u_email"
                                        placeholder="Ingresa tu correo electronico" autofocus="">
                                        <span class="error-message"></span>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Contraseña</label>
                                        <a href="auth-forgot-password-basic.html">
                                            <small>Olvidaste contraseña?</small>
                                        </a>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="u_pass" id="u_pass" class="form-control"
                                            placeholder="············" aria-describedby="password">
                                            
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        <span class="error-message"></span>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="mb-3 hide">
                                <button id="emailCode" data-url="<?= generateUrl("Access","Access","EmailCode",[],"ajax"); ?>" class="btn btn-primary d-grid w-100 " type="button">Enviar</button>
                            </div>

                            <!-- form 2 -->
                            <div class="mb-3 codediv">
                                <label for="email" class="form-label">Código de verificación</label>
                                <input name="u_code" id="u_code" type="password" 
                                class="form-control" placeholder="Ingresa tu codigo de verificación">
                            </div>
                            <div class="mb-3 codediv">
                                <button class="btn btn-primary d-grid w-100 " type="submit">Ingresar</button>
                            </div>
                            
                        </form>

                        <!-- <p class="text-center">
                            <span>¿No tienes cuenta?</span>
                            <a href="<?= generateUrl("Access","Access","RegisterView",[],"ajax"); ?>">
                                <span>Crear cuenta</span>
                            </a>
                        </p> -->
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- VALIDACION -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/validation/validationLogin.js"></script>
</body>

</html>