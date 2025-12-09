<?php
    $typeTravel = $_REQUEST["typeTravel"];
    $typeCabina = $_REQUEST["typeCabina"];
    $originCode = $_REQUEST["originCode"];
    $originCity = $_REQUEST["cityOrigin"];
    $originType = $_REQUEST["originType"];
    $destinyCode = $_REQUEST["destinyCode"];
    $destinyCity = $_REQUEST["cityDestiny"];
    $destinyType = $_REQUEST["destinyType"];
    $dateGoing = $_REQUEST["dateGoing"];
    $dateLap = $_REQUEST["dateLap"];
    $arrayPassengers = $_REQUEST["arrayPassengers"];
    $arrayPriceTxt = $_REQUEST["arrayPriceTxt"];

    // HORARIOS
    $originDepartureTime = $_REQUEST["originDepartureTime"];
    $originArrivalTime = $_REQUEST["originArrivalTime"];
    $destinyDepartureTime = $_REQUEST["destinyDepartureTime"];
    $destinyArrivalTime = $_REQUEST["destinyArrivalTime"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotiza Vuelos, Paquetes, Hoteles y Carros</title>

    <link rel="icon" href="./assets/img/favicon.ico">

    <link rel="stylesheet" href="./assets/css/airplane.css">
    <link rel="stylesheet" href="./assets/css/general.css">
</head>
<body>
    <div class="wrapper">
        <!-- Información a enviar -->
        <input id="priceGoing" type="text" value="0">
        <input id="priceLap" type="text" value="0">

        <header class="header">
            <img src="./assets/img/MobileNegative.svg" alt="">

            <div class="sub-header">
                <p class="sub-header__txt">Elige tus asientos</p>

                <div class="sub-header__carrousel">
                    <div class="sub-header__arrow sub-header__arrow--prev">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" color="#fff" focusable="false" viewBox="0 0 32 32">
                            <path d="M24.2246 27.55L12.6396 16L24.2246 4.44999L21.7746 2L7.77462 16L21.7746 30L24.2246 27.55Z" fill="currentColor"></path>
                        </svg>
                    </div>

                    <div class="sub-header__content">
                        <!-- Los elementos del carrusel serán generados aquí dinámicamente -->
                    </div>

                    <div class="sub-header__arrow sub-header__arrow--next">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" color="#fff" focusable="false" viewBox="0 0 32 32">
                            <path d="M8.16699 4.45004L19.2003 16L8.16699 27.55L10.5003 30L23.8336 16L10.5003 2L8.16699 4.45004Z" fill="currentColor"></path>
                        </svg>
                    </div>
                </div>            
            </div>
        </header>

        <main class="main">
            <div id="airplaneChair" class="airplane__float">
                <!-- Aqui se renderizan los puestos a escoger -->
            </div>

            <div class="airplane">
                <span class="airplane__name">Airbus 320</span>

                <div class="airplane__content">
                    <div class="airplane__letter-contend">
                        <div class="airplane__letter">A</div>
                        <div class="airplane__letter">B</div>
                        <div class="airplane__letter">C</div>
                        <div class="airplane__letter"></div>
                        <div class="airplane__letter">D</div>
                        <div class="airplane__letter">E</div>
                        <div class="airplane__letter">F</div>
                    </div>

                    <div id="airplane">
                        <!-- Aqui se genera el esquema del avion con JS -->
                    </div>
                </div>
            </div>
        </main>

        <div id="infoChair" class="box hidde">
            <!-- Información adicional del asiento escogido -->
        </div>

        <div id="deleteChair" class="box hidde">
            <!-- Eliminar asiento escogido -->
        </div>

        <footer class="footer">
            <form action="./baggage.php" method="POST">
                <input id="typeTravel" name="typeTravel" type="hidden" value="<?php echo $typeTravel ?>">
                <input id="typeCabina" name="typeCabina" type="hidden" value="<?php echo $typeCabina ?>">
                <input id="originCode" name="originCode" type="hidden" value="<?php echo $originCode ?>">
                <input id="originTxt" name="originCity" type="hidden" value="<?php echo $originCity ?>">
                <input id="typeGoingTxt" name="originType" type="hidden" value="<?php echo $originType ?>">
                <input id="destinyCode" name="destinyCode" type="hidden" value="<?php echo $destinyCode ?>">
                <input id="destinyTxt" name="destinyCity" type="hidden" value="<?php echo $destinyCity ?>">
                <input id="typeLapTxt" name="destinyType" type="hidden" value="<?php echo $destinyType ?>">
                <input id="dateGoing" name="dateGoing" type="hidden" value="<?php echo $dateGoing ?>">
                <input id="dateLap" name="dateLap" type="hidden" value="<?php echo $dateLap ?>">
                <input id="passengersTxt" name="arrayPassengers" type="hidden" value="<?php echo $arrayPassengers ?>">
                <input id="arrayPriceTxt" name="arrayPriceTxt" type="hidden" value="<?php echo $arrayPriceTxt ?>">
                <!-- Horaios -->
                <input name="originDepartureTime" type="hidden" value="<?php echo $originDepartureTime ?>">
                <input name="originArrivalTime" type="hidden" value="<?php echo $originArrivalTime ?>">
                <input name="destinyDepartureTime" type="hidden" value="<?php echo $destinyDepartureTime ?>">
                <input name="destinyArrivalTime" type="hidden" value="<?php echo $destinyArrivalTime ?>">

                <button id="btnContinueC" class="footer__btn" type="submit">Agregar y continuar</button>
            </form>

            <div class="footer__content">
                <span>Precio final <svg height="20" xmlns="http://www.w3.org/2000/svg" fill="none" focusable="false" viewBox="0 0 32 32"><path d="M4.45004 24.2251L16 12.6401L27.55 24.2251L30 21.7751L16 7.77511L2 21.7751L4.45004 24.2251Z" fill="currentColor"></path></svg></span>
                <span>COP <span id="totalToPay">0</span></span>
            </div>
        </footer>
    </div>

    <script src="./assets/js/airplane.js"></script>
</body>
</html>