<?php
    $typeTravel = $_REQUEST["typeTravel"];
    $originCode = $_REQUEST["originCode"];
    $originCity = $_REQUEST["originCity"];
    $originType = $_REQUEST["originType"];
    $destinyCode = $_REQUEST["destinyCode"];
    $destinyCity = $_REQUEST["destinyCity"];
    $destinyType = $_REQUEST["destinyType"];
    $dateGoing = $_REQUEST["dateGoing"];
    $dateLap = $_REQUEST["dateLap"];
    $arrayPassengers = $_REQUEST["arrayPassengers"];
    $currentPrice = $_REQUEST["currentPrice"];

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
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/passengers.css">
    <link rel="stylesheet" href="./assets/css/general.css">
    <style>
        #btnContinue {
            border-radius: 8px;
            color: #fff;
            background-color: rgb(232, 17, 75);
            border: 1px solid rgb(232, 17, 75);
            cursor: pointer;
        }

    </style> 
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <img src="./assets/img/MobileNegative.svg" alt="">
        </header>

        <main class="main">
            <h1 class="main__ttl">Pasajeros</h1>

            <div class="form">
                <div class="form__content">
                    <!-- Aqui se generan los formularios -->
                </div>
            </div>
        </main>

        <div class="footer__wrapper">
            <footer class="footer">
                <div class="footer__content">
                    <span>Precio final <svg height="20" xmlns="http://www.w3.org/2000/svg" fill="none" focusable="false" viewBox="0 0 32 32"><path d="M4.45004 24.2251L16 12.6401L27.55 24.2251L30 21.7751L16 7.77511L2 21.7751L4.45004 24.2251Z" fill="currentColor"></path></svg></span>
                    <span>COP <span id="totalToPay">0</span></span>
                </div>

                <form action="./payments.php" method="POST">
                    <input name="typeTravel" type="hidden" value="<?php echo $typeTravel ?>">
                    <input id="currentPrice" name="currentPrice" type="hidden" value="<?php echo $currentPrice ?>">
                    <input id="passengersTxt" name="arrayPassengers" type="hidden" value="<?php echo $arrayPassengers ?>">
                    <input name="originCode" type="hidden" value="<?php echo $originCode ?>">
                    <input name="originCity" type="hidden" value="<?php echo $originCity ?>">
                    <input name="destinyCode" type="hidden" value="<?php echo $destinyCode ?>">
                    <input name="destinyCity" type="hidden" value="<?php echo $destinyCity ?>">
                    <input name="dateGoing" type="hidden" value="<?php echo $dateGoing ?>">
                    <input name="dateLap" type="hidden" value="<?php echo $dateLap ?>">
                    <!-- Horaios -->
                    <input name="originDepartureTime" type="hidden" value="<?php echo $originDepartureTime ?>">
                    <input name="originArrivalTime" type="hidden" value="<?php echo $originArrivalTime ?>">
                    <input name="destinyDepartureTime" type="hidden" value="<?php echo $destinyDepartureTime ?>">
                    <input name="destinyArrivalTime" type="hidden" value="<?php echo $destinyArrivalTime ?>">

                    <button id="btnContinue" class="footer__btn" disabled>Continuar</button>
                </form>
            </footer>
        </div>
    </div>

    <script src="./assets/js/passengers.js"></script>
</body>
</html>